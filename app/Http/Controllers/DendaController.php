<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon; // Library untuk manipulasi tanggal/waktu

class DendaController extends Controller
{
    // Fungsi ini dipanggil saat Admin klik tombol "Hitung Denda"
    public function store(Request $request, $idPemesanan)
    {
        // 1. Cari Data Pemesanan
        $pemesanan = Pemesanan::findOrFail($idPemesanan);

        // Cek apakah denda sudah pernah dibuat untuk pesanan ini?
        if ($pemesanan->denda) {
            return back()->with('error', 'Denda untuk pemesanan ini sudah ada!');
        }

        // 2. Hitung Waktu Seharusnya Kembali
        // Kita perlu parsing 'Durasi_Sewa' (misal: "3 Jam", "1 Hari")
        $tanggalSewa = Carbon::parse($pemesanan->Tanggal_Sewa);
        $durasiString = strtolower($pemesanan->Durasi_Sewa);
        $waktuKembaliSeharusnya = $tanggalSewa->copy();

        if (str_contains($durasiString, 'jam')) {
            $jam = (int) filter_var($durasiString, FILTER_SANITIZE_NUMBER_INT);
            $waktuKembaliSeharusnya->addHours($jam);
        } elseif (str_contains($durasiString, 'hari')) {
            $hari = (int) filter_var($durasiString, FILTER_SANITIZE_NUMBER_INT);
            $waktuKembaliSeharusnya->addDays($hari);
        }

        // 3. Bandingkan dengan Waktu Sekarang (saat tombol ditekan)
        $waktuSekarang = Carbon::now();

        // Jika belum waktunya kembali tapi sudah ditekan (Sesuai UCS Exception 1a)
        if ($waktuSekarang->lessThan($waktuKembaliSeharusnya)) {
            return back()->with('error', 'Denda gagal dibuat. Sepeda belum melewati batas waktu sewa.');
        }

        // 4. Hitung Selisih Terlambat (dalam jam)
        // floatDiffInHours memberikan hasil desimal, misal terlambat 1 jam 30 menit = 1.5 jam
        $selisihJam = $waktuKembaliSeharusnya->floatDiffInHours($waktuSekarang);

        // 5. Terapkan Aturan Denda UCS
        $jumlahDenda = 0;
        $keteranganSelisih = "";

        if ($selisihJam <= 1) {
            // UCS: dibawah 1 jam free
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

        // 6. Simpan ke Database
        Denda::create([
            'ID_Pemesanan' => $pemesanan->ID_Pemesanan,
            'Tanggal_Denda_Dibuat' => Carbon::now(),
            'Jumlah_Denda' => $jumlahDenda,
            'Waktu_Selisih' => $keteranganSelisih,
        ]);

        return back()->with('success', 'Denda berhasil dihitung! Total: Rp ' . number_format($jumlahDenda));
    }
}