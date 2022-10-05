<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KuitansiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::group(['middleware' => 'auth'], function () {
        /*
        Dashboard
        */
        Route::get('pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan.index');
        Route::get('role', [DashboardController::class, 'role'])->name('role.index');
        Route::get('role-add', [DashboardController::class, 'roleAdd'])->name('role.create');
        Route::post('role-add', [DashboardController::class, 'roleStore'])->name('role.store');

        Route::get('menu', [DashboardController::class, 'menu'])->name('menu.index');
        Route::post('menu-add', [DashboardController::class, 'menuStore'])->name('menu.store');

        Route::get('ubah-pengaturan', [DashboardController::class, 'editPengaturan'])->name('pengaturan.edit');
        Route::post('ubah-pengaturan/{id}', [DashboardController::class, 'storePengaturan'])->name('pengaturan.store');
        Route::post('cetak-laporan-harian', [DashboardController::class, 'cetak'])->name('laporan-harian.cetak');
        Route::post('export-laporan-harian', [DashboardController::class, 'export'])->name('laporan-harian.export');
        /*
        Periode
        */
        Route::get('periode', [PeriodeController::class, 'index'])->name('periode.index');
        Route::get('periode-tambah', [PeriodeController::class, 'create'])->name('periode.create');
        Route::post('periode-tambah', [PeriodeController::class, 'store'])->name('periode.store');
        Route::get('periode/{periode}/ubah', [PeriodeController::class, 'edit'])->name('periode.edit');
        Route::post('periode/{periode}/ubah', [PeriodeController::class, 'update'])->name('periode.update');
        Route::delete('periode/{periode}/hapus', [PeriodeController::class, 'destroy'])->name('periode.destroy');
        /*
        Kelas
        */
        Route::get('kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('kelas-tambah', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('kelas-tambah', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('kelas/{kelas}/ubah', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::post('kelas/{kelas}/ubah', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('kelas/{kelas}/hapus', [KelasController::class, 'destroy'])->name('kelas.destroy');
        /*
        Siswa
        */
        Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('siswa-tambah', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('siswa-tambah', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('siswa/{siswa}/detail', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('siswa/{siswa}/ubah', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::post('siswa/{siswa}/ubah', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('siswa/{siswa}/hapus', [SiswaController::class, 'destroy'])->name('siswa.destroy');
        Route::get('import-siswa', [SiswaController::class, 'showFormImport'])->name('siswa.showimport');
        Route::post('import-siswa', [SiswaController::class, 'import'])->name('siswa.import');
        Route::get('export-siswa', [SiswaController::class, 'export'])->name('siswa.export');
        /*
        Transaksi SPP
        */
        Route::get('transaksi-spp', [TransaksiController::class, 'index'])->name('spp.index');
        Route::post('print-bukti-spp', [TransaksiController::class, 'printTF'])->name('transaksi.tf');
        Route::get('export-spp', [TransaksiController::class, 'transaksiExport'])->name('transaksi.export');
        Route::post('print-tagihan-spp/{siswa?}', [TransaksiController::class, 'print'])->name('spp.print');
        Route::post('export-spp/{siswa?}', [TransaksiController::class, 'export'])->name('spp.export');
        /*
        Keuangan
        */
        Route::get('keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::post('keuangan', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::get('export-keuangan', [KeuanganController::class, 'export'])->name('keuangan.export');
        /*
        Tabungan
        */
        Route::get('tabungan', [TabunganController::class, 'index'])->name('tabungan.index');
        Route::post('menabung', [TabunganController::class, 'menabung'])->name('tabungan.store');
        Route::get('cetak-tabungan/{id}', [TabunganController::class, 'transaksiCetak'])->name('tabungan.transaksicetak');
        Route::get('export-mutasi', [TabunganController::class, 'export'])->name('tabungan.export');
        Route::get('cetak-tabungan-siswa/{siswa}', [TabunganController::class, 'cetak'])->name('tabungan.cetak');
        Route::get('export-tabungan/{siswa}', [TabunganController::class, 'siswaexport'])->name('tabungan.siswa.export');
        /*
        Tagihan
        */
        Route::get('tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::get('tambah-tagihan', [TagihanController::class, 'create'])->name('tagihan.create');
        Route::post('tambah-tagihan', [TagihanController::class, 'store'])->name('tagihan.store');
        Route::get('tagihan/{tagihan}/ubah', [TagihanController::class, 'edit'])->name('tagihan.edit');
        Route::post('tagihan/{tagihan}/ubah', [TagihanController::class, 'update'])->name('tagihan.update');
        Route::post('tagihan/{tagihan}/hapus', [TagihanController::class, 'destroy'])->name('tagihan.destroy');
        /*
        Kuitansi - non aktif
        */
        // Route::get('kuitansi', [KuitansiController::class, 'index'])->name('kuitansi.index');
        // Route::post('kuitansi', [KuitansiController::class, 'store'])->name('kuitansi.store');
        // Route::get('kuitansi/{kuitansi}', [KuitansiController::class, 'print'])->name('kuitansi.print');
        /*
        Laporan
        */
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('cetak-data/{tglawal}/{tglakhir}', [LaporanController::class, 'cetak'])->name('cetakdata.cetak');
        /*
        user
        */
        Route::group(['middleware' => 'role:superadmin|admin'], function () {
            Route::get('user', [PenggunaController::class, 'index'])->name('user.index');
            Route::get('user-tambah', [PenggunaController::class, 'create'])->name('user.create');
            Route::post('user-tambah', [PenggunaController::class, 'store'])->name('user.store');
            Route::get('user/{user}/ubah', [PenggunaController::class, 'edit'])->name('user.edit');
            Route::post('user/{user}/ubah', [PenggunaController::class, 'update'])->name('user.update');
            Route::post('user/{user}/hapus', [PenggunaController::class, 'destroy'])->name('user.destroy');
        });
    });
});
