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
        // --- LOGIKA UPDATE OTOMATIS (Tanpa Denda) ---
        $now = \Carbon\Carbon::now();

        // Cari semua pesanan yang waktunya SUDAH LEWAT (< now)
        // TAPI status sepedanya MASIH 'Dipinjam'
        $pesananLewat = \App\Models\Pemesanan::where('Tanggal_Selesai', '<', $now)
            ->whereHas('sepeda', function ($q) {
                $q->where('Status_Sepeda', 'Dipinjam');
            })
            ->with('sepeda') // Eager load relasi sepeda
            ->get();

        // Loop dan update status sepeda jadi 'Tersedia'
        foreach ($pesananLewat as $pesanan) {
            if ($pesanan->sepeda) {
                $pesanan->sepeda->Status_Sepeda = 'Tersedia';
                $pesanan->sepeda->save(); // Simpan perubahan langsung
            }
        }
        // --- AKHIR LOGIKA ---
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
