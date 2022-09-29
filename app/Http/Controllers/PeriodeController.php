<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.periode.index', compact('periode'));
    }

    public function create()
    {
        return view('admin.periode.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tgl_mulai' => 'required|date|before:'.$request->tgl_selesai,
            'tgl_selesai' => 'required|date',
            'is_active' => 'nullable|boolean'
        ]);

        $periode = Periode::make($request->input());

        if($request->is_active == null) {
            $periode->is_active =0;
        }

        if($periode->save()) {
            return redirect()->route('periode.index')->with([
                'type' => 'success',
                'msg'=> 'Periode Ditambahkan'
            ]);
        }else{
            return redirect()->route('periode.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }
    }

    public function edit(Periode $periode)
    {
        return view('admin.periode.form', compact('periode'));
    }

    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tgl_mulai' => 'required|date|before:'.$request->tgl_selesai,
            'tgl_selesai' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $periode->fill($request->all());
        
        if($request->is_active == null){
            $periode->is_active = 0;
        }

        if($periode->save()){
            return redirect()->route('periode.index')->with([
                'type' => 'success',
                'msg' => 'Periode diubah'
            ]);
        }else{
            return redirect()->route('periode.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    public function destroy(Periode $periode)
    {
        if($periode->kelas->count() != 0){
            return redirect()->route('periode.index')->with([
                'type' => 'danger',
                'msg' => 'Tidak dapat menghapus periode yang memiliki kelas'
            ]);
        }
        if($periode->delete()){
            return redirect()->route('periode.index')->with([
                'type' => 'success',
                'msg' => 'Periode dihapus'
            ]);
        }else{
            return redirect()->route('periode.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }
}
