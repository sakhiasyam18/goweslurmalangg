<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan; // Jangan lupa import model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator

class PelangganController extends Controller
{
    /**
     * Menampilkan formulir input data pelanggan.
     */
    public function create()
    {
        // Langsung tampilkan view formulirnya
        return view('pembayaran.create');
    }

    /**
     * Menyimpan data pelanggan baru dari formulir ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:100',
            'No_Telepon' => 'required|string|max:15',
        ]);

        // 2. Jika validasi gagal, kembali ke form dengan error & input lama
        if ($validator->fails()) {
            return redirect()->route('pembayaran.create')
                ->withErrors($validator)
                ->withInput();
        }

        // 3. Jika validasi berhasil, simpan data ke tabel 'pelanggan'
        try {
            // Gunakan Model Pelanggan untuk create data
            // ID_Pelanggan akan dibuat otomatis oleh Model
            Pelanggan::create($validator->validated());

            // 4. Kembali ke form dengan pesan sukses
            return redirect()->route('pembayaran.create')
                ->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            // Jika ada error saat simpan ke DB, kembali dengan pesan error
            return redirect()->route('pembayaran.create')
                ->withErrors(['database' => 'Gagal menyimpan data. Silakan coba lagi.'])
                ->withInput();
        }
    }

    // Method lain (index, show, edit, update, destroy) bisa ditambahkan nanti jika perlu
}
