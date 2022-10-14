<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TagihanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagihan = Tagihan::orderBy('created_at','desc')->paginate(10);
        return view('admin.tagihan.index', ['tagihan' => $tagihan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::where('is_yatim','!=','1')->get();
        return view('admin.tagihan.form',[
            'kelas' => $kelas,
            'siswa' => $siswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jumlah' => 'required',
            'peserta' => 'required|numeric'
        ]);

        $hapus = trim($request->jumlah, "Rp. ");
        $hasilHapus = str_replace(".", "", $hapus);

        $tagihan = Tagihan::make($request->except('kelas_id'));
        $tagihan->jumlah = $hasilHapus;
        if($request->peserta == 1) {
            $tagihan['is_bayar'] = 0;
            $tagihan->wajib_semua = 1;
            $tagihan->save();
        }else if($request->peserta == 2){
            $tagihan['is_bayar'] = 0;
            $tagihan->kelas_id = $request->kelas_id;
            $tagihan->save();
        }else if($request->peserta == 3){
            $tagihan['is_bayar'] = 0;
            $tagihan->save();
            foreach($request->siswa_id as $siswa_id){
                $tagihan->siswa()->save(Siswa::find($siswa_id));
            }
        }else{
            return Redirect::back()->withErrors(['Peserta Wajib diisi']);
        }

        if($tagihan->save()){
            return redirect()->route('tagihan.index')->with([
                'type' => 'success',
                'msg' => 'Item Tagihan ditambahkan'
            ]);
        }else{
            return redirect()->route('tagihan.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagihan $tagihan)
    {
        $kelas = Kelas::all();
        $siswa = Siswa::where('is_yatim','!=','1')->get();
        return view('admin.tagihan.form',[
            'kelas' => $kelas,
            'siswa' => $siswa,
            'tagihan' => $tagihan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        // dd($request->all());
        $hapus = trim($request->jumlah, "Rp. ");
        $hasilHapus = str_replace(".", "", $hapus);
        $request->validate([
            'nama' => 'required|max:255',
            'jumlah' => 'required',
            'peserta' => 'required|numeric'
        ]);

        $tagihan->fill($request->except('kelas_id'));
        
        //remove all related
        $tagihan->jumlah = $hasilHapus;
        $tagihan->siswa()->detach();
        $tagihan->kelas_id = null;
        $tagihan->wajib_semua = null;

        switch($request->peserta){
            case 1: // semua
                $tagihan->wajib_semua = 1;
                break;
            case 2: // hanya kelas
                $tagihan->kelas_id = $request->kelas_id;
                break;
            case 3: // siswa , make role
                foreach($request->siswa_id as $siswa_id){
                    $tagihan->siswa()->save(Siswa::find($siswa_id));
                }
                break;
            default:
                return Redirect::back()->withErrors(['Peserta Wajib diisi']);
        }

        if($tagihan->save()){
            return redirect()->route('tagihan.index')->with([
                'type' => 'success',
                'msg' => 'Item Tagihan diubah'
            ]);
        }else{
            return redirect()->route('tagihan.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tagihan $tagihan)
    {
        if($tagihan->transaksi->count() != 0){
            return redirect()->route('tagihan.index')->with([
                'type' => 'danger',
                'msg' => 'tidak dapat menghapus tagihan yang masih memiliki transaksi'
            ]);
        }
        $tagihan->siswa()->detach();
        if($tagihan->delete()){
            return redirect()->route('tagihan.index')->with([
                'type' => 'success',
                'msg' => 'tagihan telah dihapus'
            ]);
        }
    }
}
