<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangExpController;

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

// Route::get('/index', function () {
//     return view('admin.index');
// })->name('index');

// Route::get('/member', function () {
//     return view('admin.member');
// })->name('member');

// Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/barang_exp', function () {
    return view('admin.barang_exp');
})->name('barang_exp');

// Barang Routes
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang_exp', [BarangExpController::class, 'index'])->name('barangexp.index');
Route::get('/check-and-move-expired', [BarangController::class, 'checkAndMoveExpired']);

// Kasir Routes
Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
Route::post('/kasir/checkout', [KasirController::class, 'checkout'])->name('kasir.checkout');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/simpan-pembelian', [TransaksiController::class, 'simpanPembelian'])->name('transaksi.pembelian');

// Diskon Routes
Route::get('/diskon', [DiskonController::class, 'index'])->name('diskon.index');
Route::get('/diskon/create', [DiskonController::class, 'create'])->name('diskon.create');
Route::post('/diskon', [DiskonController::class, 'store'])->name('diskon.store');
Route::get('/diskon/{id}/edit', [DiskonController::class, 'edit'])->name('diskon.edit');
Route::put('/diskon/{id}', [DiskonController::class, 'update'])->name('diskon.update');
Route::delete('/diskon/{id}', [DiskonController::class, 'destroy'])->name('diskon.destroy');

// Member Routes
Route::get('/member', [MemberController::class, 'index'])->name('member.index');
Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
Route::put('/member/{id}', [MemberController::class, 'update'])->name('member.update');
Route::delete('/member/{id}', [MemberController::class, 'destroy'])->name('member.destroy');

Route::get('/profil', [AdminController::class, 'profil'])->name('admin.profil');
Route::get('/edit-admin', [AdminController::class, 'edit'])->name('admin.edit_admin');
Route::patch('/update-admin', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

// Authentication Routes
Route::get('/login-admin', [AuthController::class, 'showLoginAdmin'])->name('loginAdmin');
Route::post('/login-admin', [AuthController::class, 'login']);
Route::get('/register-admin', [AuthController::class, 'showRegistrationAdmin'])->name('register');
Route::post('/register-admin', [AuthController::class, 'registerAdmin']);
Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout-admin');

// Authentication Routes
Route::get('/login-user', [AuthController::class, 'showLoginUser'])->name('loginUser');
Route::post('/login-user', [AuthController::class, 'login']);
Route::get('/register-user', [AuthController::class, 'showRegistrationUser'])->name('register');
Route::post('/register-user', [AuthController::class, 'registerUser']);
Route::post('/logout-user', [AuthController::class, 'logoutUser'])->name('logout-user');

Route::middleware('auth:admin')->group(function () {
    // Rute yang memerlukan autentikasi admin
    Route::get('/index', function () {
        return view('admin.index');
    })->name('index');
});

Route::middleware('auth:web')->group(function () {
    // Rute yang memerlukan autentikasi user
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});