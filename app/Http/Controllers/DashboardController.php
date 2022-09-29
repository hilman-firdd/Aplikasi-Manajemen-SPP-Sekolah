<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Keuangan;
use App\Models\Transaksi;
use App\Models\Pengaturan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanHarianExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $total_uang = Keuangan::where('tipe','in')->sum('jumlah') - Keuangan::where('tipe','out')->sum('jumlah');
        $total_uang_tabungan = Keuangan::where('tipe','in')->where('tabungan_id','!=','null')->sum('jumlah') - Keuangan::where('tipe','out')->where('tabungan_id','!=','null')->sum('jumlah');
        $total_uang_spp = Keuangan::where('tipe','in')->where('transaksi_id','!=','null')->sum('jumlah') - Keuangan::where('tipe','out')->where('transaksi_id','!=','null')->sum('jumlah');;
        $total_uang_masuk = Keuangan::where('tipe','in')->sum('jumlah');
        $total_uang_keluar = Keuangan::where('tipe','out')->sum('jumlah');

        $transaksi = Transaksi::orderBy('siswa_id','desc')->whereDate('created_at', now()->today())->get();

        $siswa = Siswa::count();
        $item = Tagihan::count();
        $kelas = Kelas::count();
        return view('dashboard', [
            'total_uang' => $total_uang,
            'total_uang_tabungan' => $total_uang_tabungan,
            'total_uang_spp' => $total_uang_spp,
            'total_uang_masuk' => $total_uang_masuk,
            'total_uang_keluar' => $total_uang_keluar,
            'transaksi' => $transaksi,
            'jumlah' => '0',
            'siswa' => $siswa,
            'item' => $item,
            'kelas' => $kelas,
        ]);
    }

    public function pengaturan(Request $request){
        $pengaturan = new Pengaturan;
        if($pengaturan->where('checker', '1')->exists()){
            $pengaturan = $pengaturan->first();
        }else{
            $pengaturan->checker = '1';
            $pengaturan->nama = 'Aplikasi SPP';
            $pengaturan->logo = 'public/logo/aplikasi-spp-1664281886.png';
            $pengaturan->save();
        }
        return view('admin.pengaturan.index', ['pengaturan' => $pengaturan]);
    }

    public function editpengaturan(){
        $pengaturan = Pengaturan::first();
        return view('admin.pengaturan.form', ['pengaturan' => $pengaturan]);
    }

    public function storePengaturan(Request $request, $id){
        $data = $request->validate([
            'nama' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
        $pengatur = Pengaturan::find($id);
        $data['nama'] = $request->nama;
        $data['checker'] = 1;
        if($request->file('logo')) {
            if($request->oldImage) {
                $path = str_replace(env("APP_URL"),'', $request->oldImage);
                $path_new = public_path().$path;
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

    public function cetak(Request $request){
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        $transaksi = Transaksi::orderBy('siswa_id','desc')->whereDate('created_at', $date)->get();

        return view('admin.dashboard.export', ['transaksi' => $transaksi, 'date' => $request->date, 'jumlah' => 0, 'print' => true]);
    }

    public function export(Request $request){
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        return Excel::download(new LaporanHarianExport($date, $request->date), 'laporan-harian-'.now().'.xlsx');
    }
}
