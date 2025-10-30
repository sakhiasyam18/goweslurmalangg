<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SepedaController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return redirect()->route('sepeda.index');
});

Route::resource('sepeda', SepedaController::class);

// Semua route CRUD sepeda
Route::get('/sepeda', [SepedaController::class, 'index'])->name('sepeda.index');
Route::get('/sepeda/create', [SepedaController::class, 'create'])->name('sepeda.create');
Route::post('/sepeda', [SepedaController::class, 'store'])->name('sepeda.store');
Route::get('/sepeda/{id}/edit', [SepedaController::class, 'edit'])->name('sepeda.edit');
Route::put('/sepeda/{id}', [SepedaController::class, 'update'])->name('sepeda.update');
Route::delete('/sepeda/{id}', [SepedaController::class, 'destroy'])->name('sepeda.destroy');
