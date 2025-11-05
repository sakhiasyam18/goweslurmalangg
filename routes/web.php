<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SepedaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\konfirm;

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
