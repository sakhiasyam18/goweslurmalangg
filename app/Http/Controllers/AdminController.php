<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Diambil dari 'rayyan' (untuk login)
use App\Models\Pemesanan; // <-- Diambil dari 'asyam' (untuk dashboard)

class AdminController extends Controller
{
    /**
     * Menampilkan halaman form login admin.
     * (Logika dari branch 'rayyan' - Sudah Benar)
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Memproses percobaan login admin.
     * (Logika dari branch 'rayyan' - Sudah Benar)
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba lakukan login (menggunakan tabel 'users' bawaan Laravel)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika berhasil, arahkan ke rute 'admin.dashboard'
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika gagal, kembali ke form login dengan pesan error
        return back()->withInput($request->only('username'))->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    /**
     * Menampilkan halaman dashboard admin DENGAN DATA.
     * (INI ADALAH PERBAIKAN KITA)
     */
    public function dashboard()
    {
        // 1. Ambil data pemesanan (sesuai perbaikan kita sebelumnya di 'asyam')
        // Kita pakai 'with' agar relasinya (pelanggan, denda, dll) ikut terambil
        $dataPemesanan = Pemesanan::with(['Pelanggan', 'sepeda', 'paket', 'denda'])
            ->orderBy('Tanggal_Mulai', 'desc') // Urutkan berdasarkan yang terbaru
            ->get();

        // 2. Kirim data tersebut ke view 'admin.dashboard'
        return view('admin.dashboard', [
            'dataPemesanan' => $dataPemesanan
        ]);
    }

    /**
     * Memproses logout admin.
     * (Tambahan baru, sangat penting!)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect()->route('admin.login');
    }
}
