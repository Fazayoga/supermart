<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangExpController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\MembershipController;

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

// Route::get('/', function () {
//     return view('homepage.home');
// })->name('homepage');

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

Route::get('/keranjang', [KeranjangController::class, 'viewCart'])->name('keranjang.index');
Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');

Route::middleware('auth:admin')->group(function () {
    // Rute yang memerlukan autentikasi admin
    Route::get('/index', function () {
        return view('admin.index');
    })->name('index');

    // Admin Routes
    Route::get('/profil-admin', [AdminController::class, 'profil'])->name('admin.profil');
    Route::get('/edit-admin', [AdminController::class, 'edit'])->name('admin.edit_admin');
    Route::patch('/update-admin', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
});

Route::middleware('auth:web')->group(function () {
    // Rute yang memerlukan autentikasi user
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // User Routes
    Route::get('/profil-user', [UserController::class, 'profil'])->name('user.profil');
    Route::get('/edit-user', [UserController::class, 'edit'])->name('user.edit_user');
    Route::patch('/update-user', [UserController::class, 'updateProfile'])->name('user.updateProfile');

    // Memberships Routes
    Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');
    Route::get('/point', [MembershipController::class, 'point'])->name('membership.point');
    Route::get('/membership/create', [MembershipController::class, 'create'])->name('membership.create');
    Route::post('/membership/store', [MembershipController::class, 'store'])->name('membership.store');
    Route::get('/membership/{id}/edit', [MembershipController::class, 'edit'])->name('membership.edit');
    Route::put('/membership/{id}', [MembershipController::class, 'update'])->name('membership.update');
    Route::delete('/membership/{id}', [MembershipController::class, 'destroy'])->name('membership.destroy');
});

// Admin Authentication Routes
Route::get('/login-admin', [AdminAuthController::class, 'showLoginForm'])->name('auth.login_admin');
Route::post('/login-admin', [AdminAuthController::class, 'login']);
Route::post('/logout-admin', [AdminAuthController::class, 'logout'])->name('logout-admin');
Route::get('/register-admin', [AdminAuthController::class, 'showRegistrationAdmin'])->name('register-admin');
Route::post('/register-admin', [AdminAuthController::class, 'registerAdmin']);

// User Authentication Routes
Route::get('/login-user', [UserAuthController::class, 'showLoginForm'])->name('auth.login_user');
Route::post('/login-user', [UserAuthController::class, 'login']);
Route::post('/logout-user', [UserAuthController::class, 'logout'])->name('logout-user');
Route::get('/register-user', [UserAuthController::class, 'showRegistrationUser'])->name('register-user');
Route::post('/register-user', [UserAuthController::class, 'registerUser']);



