<?php

use Illuminate\Support\Facades\Route;

// --- Controller ---
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\KonfirmController; // ✅ pastikan ini ditulis

// --- Controller Admin (YANG BARU) ---
use App\Http\Controllers\AdminLoginController; // <-- BARU
use App\Http\Controllers\DashboardController;  // <-- BARU
// (Controller AdminController lama dihapus)

use App\Http\Controllers\SepedaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\konfirm;


/*
|--------------------------------------------------------------------------
| JALUR A: RUTE PUBLIK (FRONT-END)
|--------------------------------------------------------------------------
*/

Route::get('/', [PelangganController::class, 'index'])->name('home');
Route::get('/pembayaran', [PelangganController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PelangganController::class, 'store'])->name('pembayaran.store');
Route::get('/konfirm/{id}', [KonfirmController::class, 'index'])->name('konfirm.page');


/*
|--------------------------------------------------------------------------
| JALUR B: RUTE ADMIN (BACK-END)
|--------------------------------------------------------------------------
*/

// --- Rute Autentikasi (Login/Logout) ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Diubah ke AdminLoginController
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
});

// --- Rute Panel Admin (WAJIB LOGIN) ---
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Diubah ke DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Diubah ke AdminLoginController
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Halaman Data Denda
    Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');

    // Proses Hitung Denda
    Route::post('/pemesanan/{id}/denda', [DendaController::class, 'store'])->name('denda.store');
});

// Redirect ke halaman sepeda
Route::get('/', function () {
    return redirect()->route('sepeda.index');
});
// Semua route CRUD otomatis
Route::resource('sepeda', SepedaController::class);

Route::get('/konfirm', [konfirm::class, 'index'])->name('konfirm.page');
// Halaman login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');

// Proses login
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// Dashboard admin (hanya bisa diakses setelah login)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');