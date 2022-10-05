<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Keuangan;
use App\Models\Transaksi;
use App\Models\Pengaturan;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanHarianExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $total_uang = Keuangan::where('tipe', 'in')->sum('jumlah') - Keuangan::where('tipe', 'out')->sum('jumlah');
        $total_uang_tabungan = Keuangan::where('tipe', 'in')->where('tabungan_id', '!=', 'null')->sum('jumlah') - Keuangan::where('tipe', 'out')->where('tabungan_id', '!=', 'null')->sum('jumlah');
        $total_uang_spp = Keuangan::where('tipe', 'in')->where('transaksi_id', '!=', 'null')->sum('jumlah') - Keuangan::where('tipe', 'out')->where('transaksi_id', '!=', 'null')->sum('jumlah');;
        $total_uang_masuk = Keuangan::where('tipe', 'in')->sum('jumlah');
        $total_uang_keluar = Keuangan::where('tipe', 'out')->sum('jumlah');

        $transaksi = Transaksi::orderBy('siswa_id', 'desc')->whereDate('created_at', now()->today())->get();


        //siswa
        $siswa = Auth::user();
        $total_uang_tabungan_siswa = DB::table('t_role')
            ->select('t_tagihan.jumlah')
            ->join('t_tagihan', 't_tagihan.id', '=', 't_role.tagihan_id')
            ->join('t_siswa', 't_siswa.id', '=', 't_role.siswa_id')
            ->where('t_tagihan.is_bayar', '!=', '1')
            ->where('t_role.siswa_id', '=', 6)->get()->toJson();

        $siswa = Siswa::count();
        $item = Tagihan::count();
        $kelas = Kelas::count();
        return view('dashboard', [
            'total_uang' => $total_uang,
            'total_uang_tabungan' => $total_uang_tabungan,
            'total_uang_spp' => $total_uang_spp,
            'total_uang_masuk' => $total_uang_masuk,
            'total_uang_keluar' => $total_uang_keluar,
            'total_uang_tabungan_siswa' => json_decode($total_uang_tabungan_siswa, true),
            'transaksi' => $transaksi,
            'jumlah' => '0',
            'siswa' => $siswa,
            'item' => $item,
            'kelas' => $kelas,
        ]);
    }

    public function pengaturan(Request $request)
    {
        $pengaturan = new Pengaturan;
        if ($pengaturan->where('checker', '1')->exists()) {
            $pengaturan = $pengaturan->first();
        } else {
            $pengaturan->checker = '1';
            $pengaturan->nama = 'Aplikasi SPP';
            $pengaturan->logo = 'public/logo/aplikasi-spp-1664281886.png';
            $pengaturan->save();
        }
        return view('admin.pengaturan.index', ['pengaturan' => $pengaturan]);
    }

    public function editpengaturan()
    {
        $pengaturan = Pengaturan::first();
        return view('admin.pengaturan.form', ['pengaturan' => $pengaturan]);
    }

    public function storePengaturan(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
        $pengatur = Pengaturan::find($id);
        $data['nama'] = $request->nama;
        $data['checker'] = 1;
        if ($request->file('logo')) {
            if ($request->oldImage) {
                $path = str_replace(env("APP_URL"), '', $request->oldImage);
                $path_new = public_path() . $path;
                unlink($path_new);
            }

            $image = $request->file('logo');
            $filenameWithoutEx = Str::slug($request->nama) . '-' . time(); //GENERATE NAMA FILE TANPA EXTENSION
            $filename = $filenameWithoutEx . '.' . $image->getClientOriginalExtension(); //GENERATE NAMA FILE DENGAN EXTENSION
            $data['logo'] = $request->file('logo')->storeAs('public/logo', $filename);
        }

        $pengatur->update($data);

        return redirect()->route('pengaturan.index')->with([
            'type' => 'success',
            'msg' => 'Pengaturan diubah'
        ]);
    }

    public function role()
    {
        $roles = Role::paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    public function roleAdd()
    {
        $permissions = Permission::get();
        $menus = Menu::get();
        return view('admin.role.create', compact('permissions', 'menus'));
    }

    public function roleStore(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        $role->attachPermission($request->permissions_id);
        return redirect()->route('role.index')->with('success', 'Data Berhasil Disimpan');
    }


    //menu
    public function menu()
    {
        $menus = Menu::get();
        return view('admin.menu.index', compact('menus'));
    }

    public function menuStore(Request $request)
    {
        $this->validate($request, [
            'menu' => ['required', 'string', 'max:255'],
        ]);

        Menu::create([
            'menu_nama' => $request->menu,
        ]);

        return redirect()->route('menu.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function cetak(Request $request)
    {
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        $transaksi = Transaksi::orderBy('siswa_id', 'desc')->whereDate('created_at', $date)->get();
        $user = User::all();

        $data = [
            'transaksi' => $transaksi,
            'date' => $request->date,
            'jumlah' => 0,
            'print' => true,
            'name' => $user[2]->name
        ];

        $pdf = \PDF::loadView('admin.dashboard.cetak', $data);
        return $pdf->stream('laporan-harian.pdf');
    }

    public function export(Request $request)
    {
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        return Excel::download(new LaporanHarianExport($date, $request->date), 'laporan-harian-' . now() . '.xlsx');
    }
}
