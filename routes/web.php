<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SepedaController;

// Redirect ke halaman sepeda
Route::get('/', function () {
    return redirect()->route('sepeda.index');
});

// Semua route CRUD otomatis
Route::resource('sepeda', SepedaController::class);
