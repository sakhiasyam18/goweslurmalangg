<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DendaController extends Controller
{
    /**
     * Menampilkan halaman Data Denda.
     */
    public function index()
    {
        $dataDenda = Denda::with('pemesanan.pelanggan')
            ->orderBy('Tanggal_Denda_Dibuat', 'desc')
            ->get();

        return view('admin.denda', ['dataDenda' => $dataDenda]);
    }

    /**
     * Hitung & simpan denda untuk sebuah pemesanan.
     */
    public function store(Request $request, $idPemesanan)
    {
        // 1) Ambil pemesanan
        $pemesanan = Pemesanan::findOrFail($idPemesanan);

        // 2) Cegah duplikasi denda
        if ($pemesanan->denda) {
            return back()->with('error', 'Denda untuk pemesanan ini sudah ada!');
        }

        // 3) Hitung selisih
        $waktuSelesai   = Carbon::parse($pemesanan->Tanggal_Selesai);
        $waktuSekarang  = Carbon::now();

        if ($waktuSekarang->lessThanOrEqualTo($waktuSelesai)) {
            return back()->with('error', 'Sepeda belum melewati batas waktu sewa. Denda belum dapat dibuat.');
        }

        $selisihJamFloat = $waktuSelesai->floatDiffInHours($waktuSekarang);

        // 4) Aturan denda
        $tarifPerJam     = 10000; // sesuaikan kebijakan
        $jamDibulatkan   = 0;
        $jumlahDenda     = 0.0;
        $keteranganSelisih = '';

        if ($selisihJamFloat <= 1) {
            // toleransi 1 jam
            $jamDibulatkan     = 0;
            $jumlahDenda       = 0.0;
            $keteranganSelisih = round($selisihJamFloat * 60) . ' Menit (Toleransi)';
        } else {
            $jamDibulatkan     = (int) ceil($selisihJamFloat);
            $jumlahDenda       = $jamDibulatkan * $tarifPerJam;
            $keteranganSelisih = $jamDibulatkan . ' Jam';
        }

        // 5) Generate ID denda
        $idDenda = 'DND-' . time() . '-' . Str::lower(Str::random(3));

        // 6) Simpan
        Denda::create([
            'ID_Denda'              => $idDenda,
            'ID_Pemesanan'          => $pemesanan->ID_Pemesanan,
            'Tanggal_Denda_Dibuat'  => $waktuSekarang,
            'Jumlah_Denda'          => $jumlahDenda,
            'Jam_Selisih'           => $jamDibulatkan,      // INT
            'Keterangan_Selisih'    => $keteranganSelisih,  // VARCHAR
        ]);

        return back()->with('success', 'Denda berhasil dihitung! Total: Rp ' . number_format($jumlahDenda, 0, ',', '.'));
    }
}