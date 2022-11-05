<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Tabungan;
use App\Models\Transaksi;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        if ($q == null) {
            $siswa = Siswa::orderBy('created_at', 'desc')
                ->paginate(5);
        } else {
            $siswa = Siswa::where('nama', 'like', '%' . $q . '%')
                ->orWhere('nik', 'like', '%' . $q . '%')
                ->orderBy('created_at', 'desc')->paginate(5);
        }

        $mySiswa = Siswa::orderBy('created_at', 'desc')
            ->where('id', Auth::user()->id)
            ->get();

        return view('admin.siswa.index', [
            'siswa' => $siswa->appends($request->only('q')),
            'mySiswa' => $mySiswa
        ]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.form', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|numeric',
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'nik' => 'required',
            'tempat_lahir' => 'nullable|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable',
            'nama_wali' => 'nullable|max:255',
            'telp_wali' => 'nullable|numeric',
            'is_yatim' => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            $siswa = Siswa::make($request->all());

            if ($request->is_yatim != null) {
                $siswa->is_yatim = 1;
            } else {
                $siswa->is_yatim = 0;
            }

            $user = User::create([
                'name' => $request->nama,
                'username' => strtolower(str_replace(' ', '', ($request->nama))),
                'nik' => $request->nik,
                'email' => $request->email,
                'password' => Hash::make($request->nik)
            ]);

            $siswa['id'] = $user->id;
            $user_id = $user->id;
            $role_id = 5;
            $user_type = 'App\Models\User';

            DB::table('role_user')->insert(
                array(
                    'role_id' => $role_id,
                    'user_id' => $user_id,
                    'user_type' => $user_type
                )
            );

            DB::commit();
            if ($siswa->save()) {
                return redirect()->route('siswa.index')->with([
                    'type' => 'success',
                    'msg' => 'Siswa ditambahkan'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('admin.siswa.form', [
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas_id' => 'required|numeric',
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'nik' => 'required',
            'tempat_lahir' => 'nullable|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable',
            'nama_wali' => 'nullable|max:255',
            'telp_wali' => 'nullable|numeric',
            'is_yatim' => 'nullable|boolean',
        ]);

        $siswa = $siswa->fill($request->all());

        if ($request->is_yatim != null) {
            $siswa->is_yatim = 1;
        } else {
            $siswa->is_yatim = 0;
        }

        if ($siswa->save()) {
            return redirect()->route('siswa.index')->with([
                'type' => 'success',
                'msg' => 'Siswa diubah'
            ]);
        } else {
            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    public function destroy(Siswa $siswa)
    {
        if (($siswa->transaksi->count() == 0) && ($siswa->tabungan->count() == 0)) {
            if ($siswa->delete()) {
                return redirect()->route('siswa.index')->with([
                    'type' => 'success',
                    'msg' => 'siswa telah dihapus'
                ]);
            }
        } else {
            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'tidak dapat menghapus siswa yang masih memiliki transaksi'
            ]);
        }
        return redirect()->route('siswa.index')->with([
            'type' => 'danger',
            'msg' => 'Err.., terjadi kesalahan'
        ]);
    }

    public function show(Siswa $siswa)
    {

        $input = Tabungan::where('tipe', 'in')->where('siswa_id', $siswa->id)->sum('jumlah');
        $output = Tabungan::where('tipe', 'out')->where('siswa_id', $siswa->id)->sum('jumlah');
        $tabungan = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at', 'desc');

        if ($tabungan->count() != 0) {
            $verify = $tabungan->first()->saldo;
        } else {
            $verify = 0;
        }
        $tabungan = $tabungan->paginate(10, ['*'], 'tabungan');

        if (($input - $output) == $verify) {
            $saldo = format_idr($input - $output);
        } else {
            $saldo = 'invalid' . format_idr($input - $output);
        }

        $tagihan = $this->getTagihan($siswa);
        return view('admin.siswa.show', [
            'siswa' => $siswa,
            'saldo' => $saldo,
            'tabungan' => $tabungan,
            'tagihan' => $tagihan
        ]);
    }

    public function showFormImport()
    {
        return view('admin.siswa.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $extensions = ["xls", "xlsx", "xlm", "xla", "xlc", "xlt", "xlw"];
            $result = [$request->file('file')->getClientOriginalExtension()];

            if (in_array($result[0], $extensions)) {
                Excel::import(new SiswaImport, $request->file('file'));
                return redirect()->route('siswa.index')->with([
                    'type' => 'success',
                    'msg' => 'data berhasil di import'
                ]);
            }

            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }

        return redirect()->route('siswa.index')->with([
            'type' => 'info',
            'msg' => 'terjadi kesalahan : no file'
        ]);
    }

    public function export()
    {
        return Excel::download(new SiswaExport, 'siswa-' . now() . '.xlsx');
    }

    protected function getTagihan(Siswa $siswa)
    {
        $tagihan = [];
        $tagihan_ids = [];

        //wajib semua
        $tagihan_wajib = Tagihan::where('wajib_semua', '1')->get()->toArray();
        //kelas only
        $tagihan_kelas = Tagihan::where('kelas_id', $siswa->kelas->id)->get()->toArray();
        //student only
        $tagihan_siswa = [];
        $tagihan_rolesiswa = $siswa->role;
        foreach ($tagihan_rolesiswa as $tag_siswa) {
            $tagihan_siswa[] = $tag_siswa->tagihan->toArray();
        }

        $tagihan_semua = array_merge($tagihan_wajib, $tagihan_kelas, $tagihan_siswa);

        foreach ($tagihan_semua as $tagih) {
            $tagihan_ids[] = $tagih['id'];
            $payed = Transaksi::where('tagihan_id', $tagih['id'])->where('siswa_id', $siswa->id)->get();
            if ($payed->count() == 0) {
                $tagihan[] = [
                    'nama' => $tagih['nama'],
                    'jumlah' => format_idr($tagih['jumlah']),
                    'diskon' => '',
                    'total' => '',
                    'is_lunas' => '0',
                    'created_at' => '',
                    'keterangan' => ''
                ];
            } else {
                foreach ($payed as $pay) {
                    $tagihan[] = [
                        'nama' => $tagih['nama'],
                        'jumlah' => format_idr($tagih['jumlah']),
                        'diskon' => format_idr($pay->diskon),
                        'total' => format_idr($pay->keuangan->jumlah),
                        'is_lunas' => $pay->is_lunas,
                        'created_at' => $pay->created_at->format('d-m-Y'),
                        'keterangan' => $pay->keterangan
                    ];
                }
            }
        }
        return $tagihan;
    }

    //api saldo
    public function getSaldo(Siswa $siswa)
    {
        if ($siswa == null) {
            return response()->json(['msg' => 'siswa tidak ditemukan'], 404);
        }
        if ($siswa->tabungan->count() == 0) {
            return response()->json(['saldo' => '0', 'sal' => '0']);
        }

        $input = Tabungan::where('tipe', 'in')->where('siswa_id', $siswa->id)->sum('jumlah');
        $output = Tabungan::where('tipe', 'out')->where('siswa_id', $siswa->id)->sum('jumlah');
        $verify = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at', 'desc')->first()->saldo;
        if (($input - $output) == $verify) {
            return response()->json(['saldo' => $input - $output, 'sal' => format_idr($input - $output)]);
        } else {
            return response()->json(['saldo' => '0', 'sal' => 'invalid ' . format_idr($input - $output)]);
        }
    }
}
