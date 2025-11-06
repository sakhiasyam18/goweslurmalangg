<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pemesanan; // <-- TAMBAHKAN INI

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // 1. Ambil input
        $username = $request->input('name'); // Standar: camelCase
        $password = $request->input('password');

        // 2. Cek apakah username ada di database
        // Standar: $user (singular) untuk satu hasil
        $user = User::where('name', $username)->first();

        if (!$user) {
            // Username tidak ditemukan
            return back()->with('error', 'Nama pengguna salah!');
        }

        // 3. Cek password (FIXED)
        // Gunakan $user->password (dari objek), bukan $username->password
        if (!Hash::check($password, $user->password)) {
            // Password tidak sesuai
            return back()->with('error', 'Password salah!');
        }

        // 4. Login berhasil (FIXED)
        // Berikan OBJEK $user ke Auth::login, bukan string $username
        Auth::login($user);

        // Selalu regenerasi session setelah login untuk keamanan
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    // UPDATE METHOD INI
    public function dashboard()
    {
        // Ambil semua data pemesanan, urutkan dari yang terbaru
        $dataPemesanan = Pemesanan::orderBy('Tanggal_Sewa', 'desc')->get();

        // Kirim data ke view
        return view('admin.dashboard', [
            'dataPemesanan' => $dataPemesanan
        ]);
    }
}
