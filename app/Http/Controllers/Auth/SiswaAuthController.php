<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    // Tampilkan form login siswa
    public function showLoginForm()
    {
        return view('pages.auth.login-siswa');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login menggunakan Guard 'siswa'
        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke dashboard siswa (kita buat nanti)
            return redirect()->intended(route('siswa.dashboard'));
        }

        return back()->withErrors([
            'nis' => 'NIS atau password salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
