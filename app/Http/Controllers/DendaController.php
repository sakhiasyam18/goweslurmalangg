<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon; // Library untuk manipulasi tanggal/waktu

class DendaController extends Controller
{
    /**
     * Fungsi ini dipanggil saat Admin klik tombol "Hitung Denda"
     * Menerima {id} dari rute: admin/pemesanan/{id}/denda
     */
    public function store(Request $request, $idPemesanan)
    {
        // 1. Cari Data Pemesanan
        $pemesanan = Pemesanan::findOrFail($idPemesanan);

        // Cek apakah denda sudah pernah dibuat untuk pesanan ini?
        // (Menggunakan relasi 'denda' yang ada di Model Pemesanan)
        if ($pemesanan->denda) {
            return back()->with('error', 'Denda untuk pemesanan ini sudah ada!');
        }

        // --- LOGIKA DIPERBARUI (SESUAI MIGRASI BARU) ---

        // 2. Ambil Waktu Seharusnya Kembali (langsung dari database)
        // Tidak perlu menghitung manual, karena sudah disimpan saat pemesanan dibuat.
        $waktuKembaliSeharusnya = Carbon::parse($pemesanan->Tanggal_Selesai);

        // 3. Bandingkan dengan Waktu Sekarang (saat tombol ditekan)
        $waktuSekarang = Carbon::now();

        // 4. Cek apakah telat?
        // Jika belum waktunya kembali (atau pas) tapi tombol sudah ditekan.
        if ($waktuSekarang->lessThanOrEqualTo($waktuKembaliSeharusnya)) {
            return back()->with('error', 'Denda gagal dibuat. Sepeda belum melewati batas waktu sewa.');
        }

        // 5. Hitung Selisih Terlambat (dalam jam)
        // floatDiffInHours memberikan hasil desimal, misal terlambat 1 jam 30 menit = 1.5 jam
        $selisihJam = $waktuKembaliSeharusnya->floatDiffInHours($waktuSekarang);

        // 6. Terapkan Aturan Denda (sesuai logika file lama)
        $jumlahDenda = 0;
        $keteranganSelisih = "";

        if ($selisihJam <= 1) {
            // UCS: dibawah 1 jam free (toleransi)
            $jumlahDenda = 0;
            $keteranganSelisih = round($selisihJam * 60) . " Menit (Toleransi)";
        } else {
            // UCS: diatas 1 jam denda 10.000
            // User request: "dibulatkan ke atas" -> artinya per jam
            // Contoh: telat 1.5 jam -> dibulatkan jadi 2 jam -> 2 x 10.000 = 20.000
            $jamDibulatkan = ceil($selisihJam);
            $jumlahDenda = $jamDibulatkan * 10000;
            $keteranganSelisih = $jamDibulatkan . " Jam";
        }

        // 7. Simpan ke Database
        Denda::create([
            'ID_Pemesanan' => $pemesanan->ID_Pemesanan,
            'Tanggal_Denda_Dibuat' => $waktuSekarang,
            'Jumlah_Denda' => $jumlahDenda,
            'Waktu_Selisih' => $keteranganSelisih,
        ]);

        return back()->with('success', 'Denda berhasil dihitung! Total: Rp ' . number_format($jumlahDenda));
    }
}