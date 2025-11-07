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
     * (PERBAIKAN: Mengambil SEMUA sepeda, termasuk yang 'Dipinjam',
     * agar bisa di-disable di tampilan)
     */
    public function index()
    {
        try {
            // --- PERUBAHAN DI SINI ---
            // Ambil SEMUA sepeda, tidak hanya yang 'Tersedia'
            $sepedaList = Sepeda::all();
            // -------------------------

            $paketTersedia = Paket::all();
            $dataPaket = [];

            // 1. Kelompokkan data Paket (Durasi) berdasarkan Kategori
            foreach ($paketTersedia as $paket) {
                $kategori = $paket->Kategori_Sepeda;

                if (!isset($dataPaket[$kategori])) {
                    $dataPaket[$kategori] = [
                        'sepeda' => [],
                        'durasi' => [],
                    ];
                }
                // Tambahkan paket (durasi) ke kategorinya
                $dataPaket[$kategori]['durasi'][] = $paket;
            }

            // 2. Kelompokkan data Sepeda berdasarkan Kategori
            // (Kita gunakan $sepedaList yang sudah berisi SEMUA sepeda)
            foreach ($sepedaList as $sepeda) {
                $kategori = $sepeda->Kategori_Sepeda;
                if (isset($dataPaket[$kategori])) {
                    // Tambahkan sepeda ke kategorinya
                    $dataPaket[$kategori]['sepeda'][] = $sepeda;
                }
            }

            // 3. Kirim data yang sudah dikelompokkan ke view
            return view('welcome', [
                'dataPaket' => $dataPaket
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memuat data landing page: ' . $e->getMessage());
            return view('welcome')->with('dataPaket', [])
                ->with('error', 'Gagal memuat data sepeda atau paket.');
        }
    }

    /**
     * Menampilkan halaman form pembayaran.
     * (Fungsi ini sudah benar, mengambil ID_Sepeda dan ID_Paket)
     */
    public function create(Request $request)
    {
        // 1. Ambil ID dari URL
        $idSepeda = $request->query('id_sepeda');
        $idPaket = $request->query('id_paket');

        // 2. Cari data di database
        $sepeda = Sepeda::find($idSepeda);
        $paket = Paket::find($idPaket);

        // 3. Validasi
        if (!$sepeda || !$paket) {
            return redirect()->route('home')->with('error', 'Sepeda atau paket pilihan Anda tidak valid.');
        }

        if ($sepeda->Status_Sepeda !== 'Tersedia') {
            return redirect()->route('home')->with('error', 'Maaf, sepeda tersebut baru saja dipinjam. Silakan pilih yang lain.');
        }

        // 4. Kirim data ke view form pembayaran
        return view('pembayaran.create', [
            'sepeda' => $sepeda,
            'paket' => $paket
        ]);
    }

    /**
     * Menyimpan data dari formulir pembayaran.
     * (Fungsi ini sudah benar, menyimpan berdasarkan ID)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:100',
            'No_Telepon' => 'required|integer',
            'Bukti_Pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ID_Sepeda' => 'required|string|exists:sepeda,ID_Sepeda',
            'ID_Paket' => 'required|string|exists:paket,ID_Paket',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // 2. Simpan Bukti Pembayaran
            $path = $request->file('Bukti_Pembayaran')->store('public/bukti_pembayaran');
            $namaFile = Str::after($path, 'public/');

            // 3. Simpan Data Pelanggan
            $pelangganBaru = Pelanggan::create([
                'Nama' => $request->Nama,
                'Alamat' => $request->Alamat,
                'No_Telepon' => $request->No_Telepon,
                'Bukti_Pembayaran' => $namaFile
            ]);

            // 4. Siapkan Data Pemesanan
            $paket = Paket::find($request->ID_Paket);
            $tanggalMulai = Carbon::now();
            $tanggalSelesai = $tanggalMulai->copy()->addHours($paket->Durasi_Jam);

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
                throw new \Exception('Sepeda dengan ID ' . $request->input('ID_Sepeda') . ' tidak ditemukan.');
            }

            // 6. Commit transaction
            DB::commit();

            // 7. Redirect ke halaman konfirmasi DENGAN ID PEMESANAN
            return redirect()->route('konfirm.page', ['id' => $pemesananBaru->ID_Pemesanan]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan pemesanan: ' . $e->getMessage());

            // Kembali ke form pembayaran (create) dengan menyertakan ID
            return redirect()->route('pembayaran.create', [
                'id_sepeda' => $request->input('ID_Sepeda'),
                'id_paket' => $request->input('ID_Paket'),
            ])
                ->withErrors(['database' => 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.'])
                ->withInput();
        }
    }
}