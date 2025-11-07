<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan; // Model yang diperlukan

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin (Data Pemesanan).
     * (Ini adalah fungsi 'dashboard' dari AdminController lama)
     */
    public function index()
    {
        // 1. Ambil data pemesanan (Sesuai perbaikan terakhir kita)
        $dataPemesanan = Pemesanan::with([
            'pelanggan', // 'P' besar sesuai Model
            'sepeda',
            'paket',
            'denda'
        ])
            ->orderBy('Tanggal_Mulai', 'desc')
            ->get();

        // 2. Kirim data ke view
        return view('admin.dashboard', [
            'dataPemesanan' => $dataPemesanan
        ]);
    }
}
