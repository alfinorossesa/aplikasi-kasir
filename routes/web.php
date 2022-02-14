<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataKasirController;
use App\Http\Controllers\DataMenuController;
use App\Http\Controllers\DataKategoriMenuController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\StokBahanController;

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

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware('auth')->group(function() {
    
    Route::get('/', [HomeController::class, 'index']);

    Route::resource('data-admin', DataAdminController::class);
    Route::resource('data-kasir', DataKasirController::class);
    Route::resource('stok-bahan', StokBahanController::class);
    Route::get('json/data-kategori-menu/{id}', [DataMenuController::class, 'jsonDataKategoriMenu'])->name('json.dataKategoriMenu');
    Route::resource('data-menu', DataMenuController::class);
    Route::resource('data-kategori-menu', DataKategoriMenuController::class);
    
    Route::get('pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('pemesanan', [PemesananController::class, 'index']);
    Route::post('pemesanan/store', [PemesananController::class, 'pemesanan'])->name('pemesanan.pemesanan');
    Route::get('pemesanan/buat-pesanan', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::get('json/data-menu/{id}', [PemesananController::class, 'jsonDataMenu'])->name('json.dataMenu');
    Route::post('pemesanan/buat-pesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('pemesanan/transaksi-pemesanan', [PemesananController::class, 'transaksiPemesanan'])->name('pemesanan.transaksiPemesanan');
    Route::post('pemesanan/transaksi-pemesanan', [PemesananController::class, 'transaksiPemesananStore'])->name('pemesanan.transaksiPemesananStore');
    Route::delete('pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
    Route::get('pemesanan/{id}/detail', [PemesananController::class, 'detail'])->name('pemesanan.detail');
    Route::get('pemesanan/cetakPDF/{id}', [PemesananController::class, 'cetakPDF'])->name('cetakPDF');
    
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('laporan', [LaporanController::class, 'index']);

    Route::get('kategori/{category}/menu', [JsonController::class, 'getMenuByCategory'])->name('menu.get');
    Route::get('harga-total', [JsonController::class, 'getTotalAmount'])->name('total_amount.get');

});


