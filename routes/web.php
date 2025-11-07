<?php

use Illuminate\Support\Facades\Route;

// --- Controller ---
use App\Http\Controllers\PelangganController; // Untuk alur pemesanan (Jalur A)
use App\Http\Controllers\DendaController;     // Untuk alur denda (Jalur B)
use App\Http\Controllers\SepedaController;   // Untuk CRUD sepeda (Jalur B)
use App\Http\Controllers\AdminController;    // Untuk login & dashboard (Jalur B)
use App\Http\Controllers\konfirm;            // Untuk halaman konfirmasi (Jalur A)

/*
|--------------------------------------------------------------------------
| JALUR A: RUTE PUBLIK & ALUR PEMESANAN (FRONT-END)
|--------------------------------------------------------------------------
|
| Rute-rute ini menangani apa yang dilihat dan dilakukan oleh pelanggan.
| Fokus utama: Landing Page -> Form Pembayaran -> Simpan Pemesanan.
|
*/

// 1. Halaman Utama (Landing Page)
// Menampilkan data sepeda & paket dari database untuk dipilih pelanggan.
Route::get('/', [PelangganController::class, 'index'])->name('home');

// 2. Halaman Form Pembayaran
// Menampilkan form setelah pelanggan memilih sepeda.
// Harapannya, data (ID sepeda, durasi) dikirim dari 'home' ke sini via query string.
Route::get('/pembayaran', [PelangganController::class, 'create'])->name('pembayaran.create');

// 3. Proses Simpan Pemesanan
// Menerima data (method POST) dari form /pembayaran untuk disimpan ke database.
Route::post('/pembayaran', [PelangganController::class, 'store'])->name('pembayaran.store');

// 4. Halaman Konfirmasi (Opsional)
// Halaman "Terima kasih" atau status setelah pemesanan berhasil.
Route::get('/konfirm', [konfirm::class, 'index'])->name('konfirm.page');


/*
|--------------------------------------------------------------------------
| JALUR B: RUTE ADMIN (BACK-END)
|--------------------------------------------------------------------------
|
| Rute-rute ini dikhususkan untuk admin, digunakan untuk mengelola
| aplikasi, data sepeda, dan melihat pemesanan.
|
*/

// --- Rute Autentikasi Admin (Login) ---
// Rute ini terpisah karena tidak memerlukan middleware 'auth'.
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// --- Grup Rute Admin yang Dilindungi (Perlu Login) ---
// Semua rute di dalam grup ini memerlukan 'auth' dan memiliki prefix '/admin'.
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // 1. Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // 2. CRUD Sepeda (Manajemen Sepeda)
    // Menghasilkan rute lengkap (index, create, store, show, edit, update, destroy)
    // Contoh: admin.sepeda.index akan mengarah ke GET /admin/sepeda
    Route::resource('sepeda', SepedaController::class);

    // 3. Proses Hitung Denda
    // Aksi POST yang dipicu dari dashboard admin untuk pemesanan tertentu.
    // URL: /admin/pemesanan/{id}/denda
    Route::post('/pemesanan/{id}/denda', [DendaController::class, 'store'])->name('denda.store');
});