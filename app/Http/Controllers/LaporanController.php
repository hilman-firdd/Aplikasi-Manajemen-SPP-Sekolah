<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Keuangan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function cetak($tgl_awal, $tgl_akhir)
    {
        $cetak = Keuangan::with(['transaksi.siswa'])
            ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->latest()->get();
        $user = User::all();

        $data = [
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'cetak' => $cetak,
            'name' => $user[3]->name
        ];
        $pdf = PDF::loadView('admin.laporan.laporankeuangan', $data);
        return $pdf->download('laporan-keuangan.pdf');
    }
}
