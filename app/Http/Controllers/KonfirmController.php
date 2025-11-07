<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class KonfirmController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi pemesanan.
     */
    public function index($id)
    {
        // Ambil data pemesanan beserta relasi (pelanggan, sepeda, paket)
        $pemesanan = Pemesanan::with(['pelanggan', 'sepeda', 'paket'])
            ->findOrFail($id); // jika ID tidak ditemukan, otomatis 404

        // Kirim data ke view 'konfirm.blade.php'
        return view('pembayaran.konfirm', [   // ✅ ubah dari 'KonfirmController' ke 'konfirm'
            'pemesanan' => $pemesanan
        ]);
    }

    // Fungsi lainnya (nggak digunakan di sini)
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}