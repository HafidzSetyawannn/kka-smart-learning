<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;

class SiswaMateriController extends Controller
{
    /**
     * Menampilkan daftar materi untuk kelas siswa.
     */
    public function index()
    {
        // 1. Ambil siswa yang login
        $siswa = Auth::guard('siswa')->user();

        // 2. Ambil materi yang HANYA untuk kelas siswa tersebut
        $materis = Materi::where('kelas_id', $siswa->kelas_id)
            ->latest()
            ->paginate(9); // Tampilkan 9 materi per halaman

        $title = 'Materi Pembelajaran';
        return view('pages.siswa.materi.index', compact('materis'));
    }

    /**
     * Menampilkan detail materi (halaman nonton/baca).
     */
    public function show($id)
    {
        // 1. Ambil materi, pastikan milik kelas siswa (agar tidak bisa intip kelas lain)
        $siswa = Auth::guard('siswa')->user();

        $materi = Materi::where('id', $id)
            ->where('kelas_id', $siswa->kelas_id)
            ->firstOrFail(); // Jika akses materi kelas lain -> Error 404

        $title = $materi->judul; // Judul halaman sesuai judul materi
        return view('pages.siswa.materi.show', compact('materi'));
    }
}
