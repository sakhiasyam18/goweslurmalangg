<!-- routes/web.php -->
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

//ini nampilkan formulir pembayaran 
Route::get('/pembayaran', [PelangganController::class, 'create'])->name('pembayaran.create');
// ini menyimpan data dari formulir
Route::post('/pembayaran', [PelangganController::class, 'store'])->name(
    'pembayaran.store'
);
