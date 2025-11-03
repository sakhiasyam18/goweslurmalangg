<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\coba;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', [coba::class, 'index'])->name('coba.page');
// Halaman login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');

// Proses login
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// Dashboard admin (hanya bisa diakses setelah login)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
