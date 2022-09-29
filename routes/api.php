<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('saldo/{siswa?}', [SiswaController::class, 'getSaldo'])->name('api.getsaldo');
Route::post('menabung/{siswa?}', [TabunganController::class, 'menabung'])->name('api.menabung');
Route::get('tagihan/{siswa?}', [TransaksiController::class, 'tagihan'])->name('api.gettagihan');
Route::post('transaksi-spp/{siswa?}', [TransaksiController::class, 'store'])->name('api.tagihan');