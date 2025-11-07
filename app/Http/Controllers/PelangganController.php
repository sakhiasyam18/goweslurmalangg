<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\Models\Pelanggan;
use App\Models\Pemesanan;
use App\Models\Sepeda;
use App\Models\Paket;
// Facades & Utilities
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PelangganController extends Controller
{
    /**
     * Menampilkan Landing Page (Halaman Awal / '/').
     *
     * Fungsi ini mengambil data Sepeda (yang Tersedia)
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
     * Menyimpan data dari formulir pembayaran.
     *
     * Alur:
     * 1. Validasi input
     * 2. Simpan file bukti pembayaran (ke storage)
     * 3. Buat record pelanggan
     * 4. Buat record pemesanan (hitung Tanggal_Selesai)
     * 5. Update status sepeda menjadi 'Dipinjam'
     * 6. Commit transaction & redirect ke halaman konfirmasi dengan ID pemesanan
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:100',
            // Sesuai kesepakatan: No_Telepon adalah integer (jika kolom DB sudah bigInteger)
            'No_Telepon' => 'required|integer',
            'Bukti_Pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ID_Sepeda' => 'required|string|exists:sepeda,ID_Sepeda',
            'ID_Paket' => 'required|string|exists:paket,ID_Paket',
        ]);

        if ($validator->fails()) {
            // Kita kirimkan lagi ID sepeda & paket agar form tidak error
            return redirect()->route('pembayaran.create', [
                'id_sepeda' => $request->input('ID_Sepeda'),
                'id_paket' => $request->input('ID_Paket'),
            ])
                ->withErrors($validator)
                ->withInput();
        }

        // Mulai transaction agar operasi DB atomik
        DB::beginTransaction();

        try {
            // 1. Simpan file bukti pembayaran
            // Menggunakan pendekatan seperti di file atas:
            // Simpan di storage 'public/bukti_pembayaran' dan ambil nama file tanpa 'public/'
            $path = $request->file('Bukti_Pembayaran')->store('public/bukti_pembayaran');
            $namaFile = Str::after($path, 'public/');

            // 2. Buat data pelanggan
            $pelangganBaru = Pelanggan::create([
                'Nama' => $request->Nama,
                'Alamat' => $request->Alamat,
                'No_Telepon' => $request->No_Telepon,
                'Bukti_Pembayaran' => $namaFile
            ]);

            // 3. Siapkan data pemesanan (hitung tanggal selesai berdasarkan paket)
            $paket = Paket::find($request->ID_Paket);
            $tanggalMulai = Carbon::now();
            $tanggalSelesai = $tanggalMulai->copy()->addHours($paket->Durasi_Jam);

            // 4. Buat data pemesanan dan simpan ke variabel $pemesananBaru
            $pemesananBaru = Pemesanan::create([
                'ID_Pelanggan' => $pelangganBaru->ID_Pelanggan,
                'ID_Paket' => $request->ID_Paket,
                'ID_Sepeda' => $request->ID_Sepeda,
                'Tanggal_Mulai' => $tanggalMulai,
                'Tanggal_Selesai' => $tanggalSelesai
            ]);

            // 5. Update status sepeda jadi 'Dipinjam'
            $sepeda = Sepeda::find($request->ID_Sepeda);
            if ($sepeda) {
                $sepeda->Status_Sepeda = 'Dipinjam';
                $sepeda->save();
            } else {
                // Pengaman jika sepeda hilang di tengah proses (seharusnya sudah ditangani oleh validasi)
                throw new \Exception('Sepeda dengan ID ' . $request->input('ID_Sepeda') . ' tidak ditemukan saat proses update status.');
            }

            // 6. Commit transaction
            DB::commit();

            // 7. Redirect ke halaman konfirmasi DENGAN ID PEMESANAN
            return redirect()->route('konfirm.page', ['id' => $pemesananBaru->ID_Pemesanan]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan pemesanan: ' . $e->getMessage());

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