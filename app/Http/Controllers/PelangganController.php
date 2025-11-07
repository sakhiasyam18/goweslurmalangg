<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;   // Model untuk tabel 'pelanggan'
use App\Models\Pemesanan;   // Model untuk tabel 'pemesanan'
use App\Models\Sepeda;      // Model untuk tabel 'sepeda'
use App\Models\Paket;       // Model untuk tabel 'paket' (Pastikan Anda sudah membuatnya)
use Illuminate\Support\Facades\Validator; // Untuk validasi input
use Illuminate\Support\Facades\Log;      // Untuk mencatat error
use Illuminate\Support\Str;              // Helper string (jika diperlukan)
use Carbon\Carbon;                       // Untuk manajemen waktu (Tanggal_Mulai/Selesai)

class PelangganController extends Controller
{
    /**
     * Menampilkan Landing Page (Halaman Awal / '/').
     *
     * Fungsi ini telah direvisi untuk mengambil data Sepeda (yang Tersedia)
     * dan data Paket, lalu mengelompokkannya ke dalam satu variabel $dataPaket
     * agar sesuai dengan kebutuhan looping di welcome.blade.php.
     */
    public function index()
    {
        try {
            // 1. Ambil semua data yang diperlukan dari database
            $sepedaTersedia = Sepeda::where('Status_Sepeda', 'Tersedia')->get();
            $paketTersedia = Paket::all(); // Asumsi Model Paket (Paket.php) sudah ada

            // 2. Siapkan struktur data $dataPaket (sesuai permintaan Blade)
            $dataPaket = [];

            // 3. Kelompokkan data Paket (Durasi) berdasarkan Kategori
            foreach ($paketTersedia as $paket) {
                $kategori = $paket->Kategori_Sepeda;

                // Buat entri kategori jika belum ada
                if (!isset($dataPaket[$kategori])) {
                    $dataPaket[$kategori] = [
                        'sepeda' => collect(), // Gunakan 'collect()' agar bisa di-push
                        'durasi' => []
                    ];
                }
                // Tambahkan paket (durasi) ke kategori
                $dataPaket[$kategori]['durasi'][] = $paket;
            }

            // 4. Masukkan data Sepeda (yang Tersedia) ke kategori yang sesuai
            foreach ($sepedaTersedia as $sepeda) {
                $kategori = $sepeda->Kategori_Sepeda;
                // Jika kategori sepeda ada di $dataPaket (artinya ada paketnya)
                if (isset($dataPaket[$kategori])) {
                    $dataPaket[$kategori]['sepeda']->push($sepeda);
                }
            }

            // 5. Kirim data yang sudah dikelompokkan ke view 'welcome'
            return view('welcome', [
                'dataPaket' => $dataPaket
            ]);
        } catch (\Exception $e) {
            // Catat error jika query database gagal
            Log::error('Gagal mengambil data untuk landing page: ' . $e->getMessage());
            // Tampilkan view welcome meski tanpa data, agar tidak error total
            return view('welcome', [
                'dataPaket' => [] // Kirim array kosong
            ])->with('error', 'Gagal memuat data sepeda. Silakan coba lagi nanti.');
        }
    }

    /**
     * Menampilkan Formulir Pembayaran (/pembayaran).
     *
     * Fungsi ini mengambil ID Sepeda dan ID Paket dari query URL (GET request),
     * memvalidasinya, dan mengirimkan detailnya (Objek Sepeda & Paket)
     * ke view 'pembayaran.create' untuk ditampilkan sebagai ringkasan.
     */
    public function create(Request $request)
    {
        // 1. Ambil ID dari URL (Contoh: /pembayaran?id_sepeda=SP001&id_paket=PK001)
        // Ini didapat dari JavaScript di welcome.blade.php
        $idSepeda = $request->query('id_sepeda');
        $idPaket = $request->query('id_paket');

        // 2. Validasi dasar: Apakah ID-nya ada?
        if (!$idSepeda || !$idPaket) {
            return redirect()->route('landing.page')->with('error', 'Silakan pilih sepeda dan paket durasi terlebih dahulu.');
        }

        try {
            // 3. Cari datanya di database
            // Pastikan sepeda yang dicari MASIH TERSEDIA
            $sepeda = Sepeda::where('ID_Sepeda', $idSepeda)
                ->where('Status_Sepeda', 'Tersedia')
                ->firstOrFail(); // Akan error jika tidak ketemu atau tidak tersedia

            $paket = Paket::findOrFail($idPaket); // Akan error jika ID paket tidak ada

            // 4. Kirim data yang sudah valid ke view formulir 'pembayaran.create'
            return view('pembayaran.create', [
                'sepeda' => $sepeda,
                'paket' => $paket
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika ID tidak ditemukan ATAU sepeda sudah dipinjam orang lain (tidak 'Tersedia')
            Log::warning('Percobaan akses pembayaran dengan ID tidak valid/tidak tersedia: ' . $e->getMessage());
            return redirect()->route('landing.page')->with('error', 'Sepeda atau paket tidak ditemukan atau sudah dipesan.');
        } catch (\Exception $e) {
            Log::error('Error di PelangganController@create: ' . $e->getMessage());
            return redirect()->route('landing.page')->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    /**
     * Menyimpan data pemesanan baru dari formulir (POST request).
     *
     * Ini adalah inti alur pemesanan:
     * 1. Validasi semua input (termasuk No_Telepon sebagai integer, sesuai kesepakatan).
     * 2. Simpan file 'Bukti_Pembayaran' ke storage.
     * 3. Buat data baru di tabel 'pelanggan' (mendapatkan ID_Pelanggan).
     * 4. Buat data baru di tabel 'pemesanan' (menggunakan ID_Pelanggan).
     * 5. Hitung 'Tanggal_Selesai' secara otomatis.
     * 6. Ubah 'Status_Sepeda' menjadi 'Dipinjam'.
     * 7. Redirect ke halaman konfirmasi WA.
     */
    public function store(Request $request)
    {
        // 1. VALIDASI INPUT FORMULIR
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:100',
            // Sesuai kesepakatan kita: No_Telepon adalah integer (bukan string)
            // (Ini mengharuskan migrasi database diubah ke bigInteger)
            'No_Telepon' => 'required|integer',
            'Bukti_Pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
            // Validasi hidden fields (keamanan)
            'ID_Sepeda' => 'required|string|exists:sepeda,ID_Sepeda',
            'ID_Paket' => 'required|string|exists:paket,ID_Paket',
        ]);

        // Jika validasi gagal, kembalikan ke formulir dengan error & input lama
        if ($validator->fails()) {
            // Kita kirimkan lagi ID sepeda & paket agar form tidak error
            return redirect()->route('pembayaran.create', [
                'id_sepeda' => $request->input('ID_Sepeda'),
                'id_paket' => $request->input('ID_Paket'),
            ])
                ->withErrors($validator) // Kirim pesan error validasi
                ->withInput(); // Kirim input lama (Nama, Alamat) agar tidak hilang
        }

        try {
            // 2. SIMPAN BUKTI PEMBAYARAN
            // Simpan file di 'storage/app/public/bukti_pembayaran'
            // Pastikan Anda sudah menjalankan `php artisan storage:link`
            $path = $request->file('Bukti_Pembayaran')->store('bukti_pembayaran', 'public');
            // $path akan berisi 'bukti_pembayaran/namafile.jpg'

            // 3. BUAT DATA PELANGGAN
            // ID_Pelanggan akan ter-generate otomatis oleh Model Pelanggan.php
            $pelangganBaru = Pelanggan::create([
                'Nama' => $request->input('Nama'),
                'Alamat' => $request->input('Alamat'),
                'No_Telepon' => $request->input('No_Telepon'),
                'Bukti_Pembayaran' => $path // Simpan path filenya
            ]);

            // 4. SIAPKAN DATA PEMESANAN
            $paket = Paket::find($request->input('ID_Paket'));
            $tanggalMulai = Carbon::now(); // Waktu saat ini

            // Logika inti: Hitung Tanggal_Selesai
            // Tambahkan jam berdasarkan Durasi_Jam dari paket yang dipilih
            $tanggalSelesai = $tanggalMulai->copy()->addHours($paket->Durasi_Jam);

            // 5. BUAT DATA PEMESANAN
            // ID_Pemesanan akan ter-generate otomatis oleh Model Pemesanan.php
            Pemesanan::create([
                'ID_Pelanggan' => $pelangganBaru->ID_Pelanggan, // Ambil ID dari langkah 3
                'ID_Paket' => $paket->ID_Paket,
                'ID_Sepeda' => $request->input('ID_Sepeda'),
                'Tanggal_Mulai' => $tanggalMulai,
                'Tanggal_Selesai' => $tanggalSelesai
                // Pastikan Model 'Pemesanan' Anda memiliki $fillable yang sesuai
            ]);

            // 6. UBAH STATUS SEPEDA (PENTING!)
            // Cari sepeda yang dipesan, lalu ubah statusnya
            $sepedaDipesan = Sepeda::find($request->input('ID_Sepeda'));
            if ($sepedaDipesan) {
                $sepedaDipesan->Status_Sepeda = 'Dipinjam'; // Ganti jadi 'Dipinjam'
                $sepedaDipesan->save();
            } else {
                // Seharusnya tidak terjadi karena ada validasi 'exists' di atas
                // Tapi ini sebagai pengaman jika data hilang di tengah proses
                throw new \Exception('Sepeda dengan ID ' . $request->input('ID_Sepeda') . ' tidak ditemukan saat proses update status.');
            }

            // 7. SUKSES!
            // Redirect ke halaman konfirmasi WA (sesuai rute di web.php)
            return redirect()->route('konfirm.page');
        } catch (\Exception $e) {
            // Jika terjadi error saat proses simpan database atau file
            Log::error('Gagal menyimpan pemesanan: ' . $e->getMessage());

            // Kembalikan ke formulir dengan pesan error
            return redirect()->route('pembayaran.create', [
                'id_sepeda' => $request->input('ID_Sepeda'),
                'id_paket' => $request->input('ID_Paket'),
            ])
                ->withErrors(['database' => 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /*
     * Catatan: Metode lain seperti show, edit, update, destroy
     * tidak digunakan dalam alur pelanggan ini, jadi dihapus
     * dari controller ini agar tetap bersih (sesuai file asli Anda).
     */
}