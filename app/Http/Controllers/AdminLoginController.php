<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Menampilkan halaman form login admin.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Memproses percobaan login admin.
     */
    public function login(Request $request)
    {
        // 1. Validasi input (Sesuai perbaikan terakhir kita)
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika berhasil, arahkan ke rute 'admin.dashboard'
            return redirect()->intended(route('admin.dashboard'));
        }

        // 3. Jika gagal, kembali ke form login dengan pesan error
        return back()->withInput($request->only('name'))->withErrors([
            'name' => 'Username atau password salah.',
        ]);
    }

    /**
     * Memproses logout admin.
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