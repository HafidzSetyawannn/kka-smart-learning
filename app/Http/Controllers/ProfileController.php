<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        // Cek siapa yang login
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $role = 'guru';
        } else {
            $user = Auth::guard('siswa')->user();
            $role = 'siswa';
        }

        $title = 'Profil Saya';
        return view('pages.profile.edit', compact('user', 'role', 'title'));
    }

    public function update(Request $request)
    {
        // Deteksi user
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $guard = 'web';
        } else {
            $user = Auth::guard('siswa')->user();
            $guard = 'siswa';
        }

        // 1. Validasi Dasar
        $request->validate([
            // Validasi nama/nama_siswa tergantung role
            'name' => $guard == 'web' ? 'required|string|max:255' : 'nullable',
            'nama_siswa' => $guard == 'siswa' ? 'required|string|max:255' : 'nullable',

            // Validasi upload foto
            'avatar' => 'nullable|image|max:2048',

            // Validasi Password (Opsional, hanya jika diisi)
            'password' => 'nullable|min:6|confirmed', // confirmed berarti butuh field 'password_confirmation'
        ]);

        // 2. Update Nama
        if ($guard == 'web') {
            $user->name = $request->name;
            // Email biasanya tidak boleh ganti sembarangan, jadi kita skip
        } else {
            $user->nama_siswa = $request->nama_siswa;
        }

        // 3. Update Password (Jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 4. Update Avatar (Jika ada upload)
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan baru
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
