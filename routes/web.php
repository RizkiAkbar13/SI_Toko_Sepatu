<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->middleware('guest');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('transaksi-data', [DashboardController::class, 'getTransaksiData']);
    Route::resource('barang', BarangController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('suplier', SuplierController::class);
    Route::resource('pembeli', PembeliController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('transaksi/bayar/{id}', [TransaksiController::class, 'bayarTransaksi']);
    Route::get('transaksi/cetak/{id}', [TransaksiController::class, 'cetakStruk']);
    Route::resource('pembayaran', PembayaranController::class);

    Route::get('export/barang', [BarangController::class, 'export']);
    Route::get('export/pembayaran', [PembayaranController::class, 'export']);
    Route::get('export/pembeli', [PembeliController::class, 'export']);
    Route::get('export/pengguna', [PenggunaController::class, 'export']);
    Route::get('export/suplier', [SuplierController::class, 'export']);
    Route::get('export/transaksi', [TransaksiController::class, 'export']);
});
