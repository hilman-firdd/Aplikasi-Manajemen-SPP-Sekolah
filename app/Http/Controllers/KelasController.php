<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Periode;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $periode = Periode::all();
        return view('admin.kelas.form', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'nullable|numeric',
            'nama' => 'required|max:255'
        ]);

        if(Kelas::create($request->all())){
            return redirect()->route('kelas.index')->with([
                'type' => 'success',
                'msg' => 'Kelas ditambahkan'
            ]);
        }else{
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }
    }

    public function edit(Kelas $kelas)
    {
        $periode = Periode::all();
        return view('admin.kelas.form', compact('kelas', 'periode'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'periode_id' => 'nullable|numeric',
            'nama' => 'required|max:255'
        ]);

        if($kelas->fill($request->all())->save()){
            return redirect()->route('kelas.index')->with([
                'type' => 'success',
                'msg' => 'Kelas berhasil di update'
            ]);
        }else{
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }
    }

    public function destroy(Kelas $kelas)
    {
        if($kelas->siswa->count() != 0){
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'Tidak dapat menghapus kelas yang memiliki siswa'
            ]);
        }
        
        if($kelas->delete()){
            return redirect()->route('kelas.index')->with([
                'type' => 'success',
                'msg' => 'Berhasil dihapus'
            ]);
        }else{
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }
    }
}
