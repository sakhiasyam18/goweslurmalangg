<?php

use Illuminate\Support\Facades\Route;

// --- Controller Publik ---
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KonfirmController;

// --- Controller Admin ---
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SepedaController;
use App\Http\Controllers\DendaController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (FRONT-END)
|--------------------------------------------------------------------------
*/
Route::get('/', [PelangganController::class, 'index'])->name('home');
Route::get('/pembayaran', [PelangganController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PelangganController::class, 'store'])->name('pembayaran.store');
Route::get('/konfirm/{id}', [KonfirmController::class, 'index'])->name('konfirm.page');

/*
|--------------------------------------------------------------------------
| RUTE ADMIN (BACK-END)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // --- Login ---
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');

    // --- Dashboard dan fitur (Wajib Login) ---
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

        // CRUD Data Sepeda
        Route::resource('sepeda', SepedaController::class);

        // Data Denda
        Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
        Route::post('/pemesanan/{id}/denda', [DendaController::class, 'store'])->name('denda.store');
    });
});
