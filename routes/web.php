<?php

use Illuminate\Support\Facades\Route;

// Controller dari branch Anda (asyam)
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DendaController;

// Controller dari branch tim Anda (rayyan-crud-sepeda)
use App\Http\Controllers\SepedaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\konfirm;

/*
|--------------------------------------------------------------------------
| Rute Jalur C (Front-end Naila)
|--------------------------------------------------------------------------
*/

// Rute utama (/) sekarang menampilkan frontend dari Naila
Route::get('/', function () {
    return view('welcome'); // Ini dari branch naila
});

/*
|--------------------------------------------------------------------------
| Rute Jalur B (Admin, Sepeda, Konfirm)
|--------------------------------------------------------------------------
*/

// Semua route CRUD sepeda
Route::resource('sepeda', SepedaController::class);

// Rute halaman konfirmasi
Route::get('/konfirm', [konfirm::class, 'index'])->name('konfirm.page');

// Rute Admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Rute Jalur A (Pemesanan/Pembayaran Anda)
|--------------------------------------------------------------------------
*/

//ini nampilkan denda
Route::post('/admin/pemesanan/{id}/denda', [DendaController::class, 'store'])->name('denda.store');
//ini nampilkan formulir pembayaran 
Route::get('/pembayaran', [PelangganController::class, 'create'])->name('pembayaran.create');
// ini menyimpan data dari formulir
Route::post('/pembayaran', [PelangganController::class, 'store'])->name(
    'pembayaran.store'
);
