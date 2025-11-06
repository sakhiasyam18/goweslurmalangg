<?php

namespace App\Http\Controllers;

// Tambahkan Request
use Illuminate\Http\Request;

use App\Models\Pelanggan; //
use Illuminate\Support\Facades\Validator; //
use Illuminate\Support\Str; //

class PelangganController extends Controller
{
    /**
     * Menampilkan formulir input data pelanggan.
     */

    // --- INI FUNGSI CREATE YANG BENAR (DARI LANGKAH 1) ---
    // Tugasnya: Menampilkan form + data ringkasan pesanan
    public function create(Request $request)
    {
        // 1. Ambil data dari query URL, jika tidak ada, isi default
        $namaSepeda = $request->query('sepeda', '(Belum dipilih)');
        $durasiSewa = $request->query('durasi', '(Belum dipilih)');

        // 2. Kirim data ke view
        return view('pembayaran.create', [
            'namaSepeda' => $namaSepeda,
            'durasiSewa' => $durasiSewa
        ]);
    }

    /**
     * Menyimpan data pelanggan baru dari formulir ke database.
     */

    // --- INI FUNGSI STORE YANG BENAR (KODE YANG ANDA PASTE) ---
    // Tugasnya: Memvalidasi dan menyimpan data
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:100',
            'No_Telepon' => 'required|string|max:15',
            'Bukti_Pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048', // maks 2MB

            // Validasi input tersembunyi (opsional tapi bagus)
            'Nama_Sepeda' => 'required|string',
            'Durasi_Sewa' => 'required|string',
        ]);

        // 2. Jika validasi gagal, kembali ke form dengan error & input lama
        if ($validator->fails()) {
            // PERBAIKAN: Kirim kembali data sepeda & durasi agar ringkasan tidak hilang
            return redirect()->route('pembayaran.create', [
                'sepeda' => $request->input('Nama_Sepeda'),
                'durasi' => $request->input('Durasi_Sewa'),
            ])
                ->withErrors($validator)
                ->withInput();
        }

        // 3. Jika validasi berhasil, proses file dan simpan data
        try {
            // Ambil data yang sudah divalidasi (kecuali file)
            $validatedData = $validator->validated();

            // Proses Upload File
            if ($request->hasFile('Bukti_Pembayaran')) {
                $path = $request->file('Bukti_Pembayaran')->store('public/bukti_pembayaran');
                $validatedData['Bukti_Pembayaran'] = Str::after($path, 'public/');
            }

            // Hapus data 'Nama_Sepeda' dan 'Durasi_Sewa' dari $validatedData
            // karena tabel 'pelanggan' tidak punya kolom ini.
            // (Kita simpan ini di tabel 'pemesanan' nanti)
            unset($validatedData['Nama_Sepeda']);
            unset($validatedData['Durasi_Sewa']);

            // Gunakan Model Pelanggan untuk create data
            Pelanggan::create($validatedData);

            // 4. Kembali ke form dengan pesan sukses
            return redirect()->route('pembayaran.create')
                ->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            // Jika ada error saat simpan ke DB, kembali dengan pesan error
            return redirect()->route('pembayaran.create', [
                'sepeda' => $request->input('Nama_Sepeda'),
                'durasi' => $request->input('Durasi_Sewa'),
            ])
                ->withErrors(['database' => 'Gagal menyimpan data. Silakan coba lagi. Error: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // Method lain (index, show, edit, update, destroy) bisa ditambahkan nanti jika perlu
}
