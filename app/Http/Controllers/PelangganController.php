<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Pemesanan; // Tambahkan Model Pemesanan
use App\Models\Sepeda;    // Tambahkan Model Sepeda (untuk cek harga)
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PelangganController extends Controller
{
    public function create(Request $request)
    {
        $namaSepeda = $request->query('sepeda', '(Belum dipilih)');
        $durasiSewa = $request->query('durasi', '(Belum dipilih)');

        return view('pembayaran.create', [
            'namaSepeda' => $namaSepeda,
            'durasiSewa' => $durasiSewa
        ]);
    }

    public function store(Request $request)
    {
        // 1. VALIDASI INPUT
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:100',
            'No_Telepon' => 'required|string|max:15',
            'Bukti_Pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'Nama_Sepeda' => 'required|string',
            'Durasi_Sewa' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pembayaran.create', [
                'sepeda' => $request->input('Nama_Sepeda'),
                'durasi' => $request->input('Durasi_Sewa'),
            ])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // 2. SIAPKAN DATA PELANGGAN
            $dataPelanggan = $validator->safe()->only(['Nama', 'Alamat', 'No_Telepon']);

            // Proses Upload File
            if ($request->hasFile('Bukti_Pembayaran')) {
                $path = $request->file('Bukti_Pembayaran')->store('public/bukti_pembayaran');
                $dataPelanggan['Bukti_Pembayaran'] = Str::after($path, 'public/');
            }

            // SIMPAN KE TABEL PELANGGAN
            $pelangganBaru = Pelanggan::create($dataPelanggan);

            // 3. CARI DATA SEPEDA (Berdasarkan nama yang dikirim dari form)
            $namaSepeda = $request->input('Nama_Sepeda');
            // Asumsi: kolom nama di tabel sepeda adalah 'merk' atau 'tipe'. 
            // Sesuaikan 'merk' dengan nama kolom asli di database Anda jika berbeda.
            $sepeda = Sepeda::where('merk', $namaSepeda)->orWhere('tipe', $namaSepeda)->first();

            // Jika sepeda tidak ditemukan di DB, pakai ID dummy atau error (untuk sementara kita pakai dummy jika null)
            $idSepeda = $sepeda ? $sepeda->id_sepeda : 'SEP-UNKNOWN';
            $hargaSewaPerJam = $sepeda ? $sepeda->harga_sewa : 50000; // Default jika tidak ketemu

            // 4. HITUNG TOTAL BIAYA (Sederhana)
            $durasiStr = $request->input('Durasi_Sewa');
            $durasiAngka = (int) filter_var($durasiStr, FILTER_SANITIZE_NUMBER_INT);
            // Jika durasi dalam 'hari', kalikan 24 jam (opsional, tergantung bisnis Anda)
            if (Str::contains(strtolower($durasiStr), 'hari')) {
                $durasiAngka = $durasiAngka * 24;
            }
            // Total = Durasi * Harga
            $totalBiaya = $durasiAngka * $hargaSewaPerJam;

            // 5. SIMPAN KE TABEL PEMESANAN
            Pemesanan::create([
                'ID_Pelanggan' => $pelangganBaru->ID_Pelanggan, // Ambil ID dari pelanggan yang baru dibuat
                'ID_Sepeda' => $idSepeda,
                'Tanggal_Sewa' => Carbon::now(),
                'Durasi_Sewa' => $request->input('Durasi_Sewa'),
                'Total_Biaya' => $totalBiaya,
                'Status_Pemesanan' => 'Menunggu Konfirmasi'
            ]);

            // 6. SUKSES!
            return redirect()->route('pembayaran.create')
                ->with('success', 'Pesanan berhasil! Mohon tunggu konfirmasi admin.');
        } catch (\Exception $e) {
            return redirect()->route('pembayaran.create', [
                'sepeda' => $request->input('Nama_Sepeda'),
                'durasi' => $request->input('Durasi_Sewa'),
            ])
                ->withErrors(['database' => 'Terjadi kesalahan sistem: ' . $e->getMessage()])
                ->withInput();
        }
    }
}