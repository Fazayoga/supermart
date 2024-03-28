<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangExpController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\CashierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/index', function () {
    return view('admin.index');
})->name('index');

Route::get('/member', function () {
    return view('admin.member');
})->name('member');

Route::get('/barang_exp', function () {
    return view('admin.barang_exp');
})->name('barang_exp');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/check-and-move-expired', [BarangController::class, 'checkAndMoveExpired']);

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
Route::post('/kasir/checkout', [KasirController::class, 'checkout'])->name('kasir.checkout');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/simpan-pembelian', [TransaksiController::class, 'simpanPembelian'])->name('transaksi.pembelian');

Route::get('/barang_exp', [BarangExpController::class, 'index'])->name('barangexp.index');

Route::get('/diskon', [DiskonController::class, 'index'])->name('diskon.index');
Route::get('/diskon/create', [DiskonController::class, 'create'])->name('diskon.create');
Route::post('/diskon', [DiskonController::class, 'store'])->name('diskon.store');
Route::get('/diskon/{id}/edit', [DiskonController::class, 'edit'])->name('diskon.edit');
Route::put('/diskon/{id}', [DiskonController::class, 'update'])->name('diskon.update');
Route::delete('/diskon/{id}', [DiskonController::class, 'destroy'])->name('diskon.destroy');
