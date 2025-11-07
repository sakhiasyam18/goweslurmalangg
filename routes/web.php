<?php

use Illuminate\Support\Facades\Route;

// --- Controller ---
use App\Http\Controllers\PelangganController; // (asyam)
use App\Http\Controllers\DendaController;     // (asyam)
// use App\Http\Controllers\SepedaController; // <-- KITA HAPUS (rayyan)
use App\Http\Controllers\AdminController;    // (Gabungan)
use App\Http\Controllers\konfirm;            // (asyam)

/*
|--------------------------------------------------------------------------
| JALUR A: RUTE PUBLIK (FRONT-END)
|--------------------------------------------------------------------------
*/

Route::get('/', [PelangganController::class, 'index'])->name('home');
Route::get('/pembayaran', [PelangganController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PelangganController::class, 'store'])->name('pembayaran.store');
Route::get('/konfirm', [konfirm::class, 'index'])->name('konfirm.page');


/*
|--------------------------------------------------------------------------
| JALUR B: RUTE ADMIN (BACK-END)
|--------------------------------------------------------------------------
*/

// --- Rute Autentikasi (Login/Logout) ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
});

// --- Rute Panel Admin (WAJIB LOGIN) ---
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard (Menampilkan Data Pemesanan)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Logout
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // --- PERUBAHAN DI SINI ---

    // 1. Rute BARU untuk menampilkan halaman "Data Denda"
    Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');

    // 2. Rute untuk proses Hitung Denda (tetap sama)
    Route::post('/pemesanan/{id}/denda', [DendaController::class, 'store'])->name('denda.store');

    // 3. Rute CRUD Sepeda (kita hapus/nonaktifkan sesuai arahan)
    // Route::resource('sepeda', SepedaController::class);
});