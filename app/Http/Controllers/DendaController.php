<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DendaController extends Controller
{
    /**
     * (FUNGSI BARU)
     * Menampilkan halaman Data Denda (sesuai UI/UX).
     * Dipanggil oleh rute 'admin.denda.index'.
     */
    public function index()
    {
        // 1. Ambil semua data denda dari database
        // Kita gunakan 'with' agar data relasinya (pemesanan & pelanggan) ikut terambil
        $dataDenda = Denda::with('pemesanan.pelanggan')
            ->orderBy('Tanggal_Denda_Dibuat', 'desc') // Tampilkan yang terbaru
            ->get();

        // 2. Kirim data ke view 'admin.denda' (yang akan kita buat)
        return view('admin.denda', [
            'dataDenda' => $dataDenda
        ]);
    }

    /**
     * (FUNGSI LAMA - TETAP SAMA)
     * Menyimpan data denda baru saat Admin klik tombol "Hitung Denda".
     * Dipanggil oleh rute 'admin.denda.store'.
     */
    public function store(Request $request, $idPemesanan)
    {
        // 1. Cari Data Pemesanan (INI YANG PENTING)
        // Kita cari manual di model 'Pemesanan' menggunakan ID yang dikirim
        try {
            $pemesanan = Pemesanan::findOrFail($idPemesanan);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Gagal menemukan data pemesanan dengan ID: ' . $idPemesanan);
        }

        // 2. Cek apakah denda sudah pernah dibuat
        if ($pemesanan->denda) {
            return back()->with('error', 'Denda untuk pemesanan ini sudah ada!');
        }

        // --- LOGIKA PERHITUNGAN DENDA (Sesuai kode sebelumnya) ---

        // 3. Ambil Waktu Seharusnya Kembali
        $waktuKembaliSeharusnya = Carbon::parse($pemesanan->Tanggal_Selesai);

        // 4. Bandingkan dengan Waktu Sekarang
        $waktuSekarang = Carbon::now();

        // 5. Cek apakah telat?
        if ($waktuSekarang->lessThanOrEqualTo($waktuKembaliSeharusnya)) {
            return back()->with('error', 'Denda gagal dibuat. Sepeda belum melewati batas waktu sewa.');
        }

        // 6. Hitung Selisih Terlambat (dalam jam)
        $selisihJam = $waktuKembaliSeharusnya->floatDiffInHours($waktuSekarang);

        // 7. Terapkan Aturan Denda
        $jumlahDenda = 0;
        $keteranganSelisih = "";

        if ($selisihJam <= 1) { // Toleransi 1 jam
            $jumlahDenda = 0;
            $keteranganSelisih = round($selisihJam * 60) . " Menit (Toleransi)";
        } else {
            $jamDibulatkan = ceil($selisihJam);
            $jumlahDenda = $jamDibulatkan * 10000;
            $keteranganSelisih = $jamDibulatkan . " Jam";
        }

        // 8. Simpan ke Database Denda
        Denda::create([
            'ID_Pemesanan' => $pemesanan->ID_Pemesanan,
            'Tanggal_Denda_Dibuat' => $waktuSekarang,
            'Jumlah_Denda' => $jumlahDenda,
            'Waktu_Selisih' => $keteranganSelisih,
        ]);

        return back()->with('success', 'Denda berhasil dihitung! Total: Rp ' . number_format($jumlahDenda));
    }
}
