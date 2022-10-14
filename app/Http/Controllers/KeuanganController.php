<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Exports\KeuanganExport;
use Maatwebsite\Excel\Facades\Excel;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::orderBy('created_at', 'desc')->paginate(10);
        // $totalkd = Keuangan::all()->toArray();
        // $jumlahIN = 0;
        // $jumlahOut = 0;
        // $data = Keuangan::get();
        // foreach ($data as $dat) {
        //     if ($dat['tipe'] == 'in') {
        //         $jumlahIN += $dat['jumlah'];
        //     } else if ($dat['tipe'] == 'out') {
        //         $jumlahOut += $dat['jumlah'];
        //     }
        // }
        // $totalKD = $jumlahIN - $jumlahOut;
        return view('admin.keuangan.index', [
            'keuangan' => $keuangan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'keperluan' => 'required|in:in,out',
            'jumlah' => 'required',
            'keterangan' => 'nullable',
        ]);

        $hapus = trim($request->jumlah, "Rp. ");
        $hasilHapus = str_replace(".", "", $hapus);

        $keuangan = Keuangan::orderBy('created_at', 'desc')->first();
        if ($keuangan != null) {
            $simpan = Keuangan::make([
                'tipe' => $request->keperluan,
                'jumlah' => $hasilHapus,
                'keterangan' => $request->keterangan
            ]);
            if ($request->keperluan == 'in') {
                $simpan->total_kas = $keuangan->total_kas + $hasilHapus;
            } else if ($request->keperluan == 'out') {
                $simpan->total_kas = $keuangan->total_kas - $hasilHapus;
            }
        } else {
            $simpan = Keuangan::make([
                'tipe' => $request->keperluan,
                'jumlah' => $hasilHapus,
                'keterangan' => $request->keterangan
            ]);
            $simpan->total_kas = $hasilHapus;
        }

        if ($simpan->save()) {
            return redirect()->route('keuangan.index')->with([
                'type' => 'success',
                'msg' => 'Pencatatan Keuangan dibuat'
            ]);
        } else {
            return redirect()->route('keuangan.index')->with([
                'type' => 'danger',
                'msg' => 'Terjadi Kesalahan'
            ]);
        }
    }

    public function export()
    {
        return Excel::download(new KeuanganExport, 'mutasi_keuangan-' . now() . '.xlsx');
    }
}
