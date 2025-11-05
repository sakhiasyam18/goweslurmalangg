<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan; // Jangan lupa import model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use Illuminate\Support\Str; // Import Str untuk helper path

class PelangganController extends Controller
{
    /**
     * Menampilkan formulir input data pelanggan.
     */
    public function create()
    {
        // Baris ini sudah benar, tidak perlu diubah
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
            // TAMBAHKAN VALIDASI UNTUK FILE UPLOAD
            'Bukti_Pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048', // maks 2MB
        ]);

        // 2. Jika validasi gagal, kembali ke form dengan error & input lama
        if ($validator->fails()) {
            return redirect()->route('pembayaran.create')
                ->withErrors($validator)
                ->withInput();
        }

        // 3. Jika validasi berhasil, proses file dan simpan data
        try {
            // Ambil data yang sudah divalidasi (kecuali file)
            $validatedData = $validator->validated();

            // Proses Upload File
            if ($request->hasFile('Bukti_Pembayaran')) {
                // Simpan file ke storage/app/public/bukti_pembayaran
                // Nama file akan di-generate unik oleh Laravel
                $path = $request->file('Bukti_Pembayaran')->store('public/bukti_pembayaran');

                // Hapus 'public/' dari path untuk disimpan di DB
                // Sehingga hasilnya 'bukti_pembayaran/namafile.jpg'
                $validatedData['Bukti_Pembayaran'] = Str::after($path, 'public/');
            }

            // Gunakan Model Pelanggan untuk create data
            // ID_Pelanggan akan dibuat otomatis oleh Model
            Pelanggan::create($validatedData);

            // 4. Kembali ke form dengan pesan sukses
            return redirect()->route('pembayaran.create')
                ->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            // Jika ada error saat simpan ke DB, kembali dengan pesan error
            return redirect()->route('pembayaran.create')
                // Tambahkan pesan error database
                ->withErrors(['database' => 'Gagal menyimpan data. Silakan coba lagi. Error: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // Method lain (index, show, edit, update, destroy) bisa ditambahkan nanti jika perlu
}
