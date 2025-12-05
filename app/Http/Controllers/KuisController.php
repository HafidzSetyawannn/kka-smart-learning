<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    /**
     * Menampilkan daftar semua kuis.
     */
    public function index()
    {
        $kuis = Kuis::with('kelas')->latest()->paginate(10);
        $title = 'Manajemen Kuis';

        return view('pages.kuis.index', compact('kuis', 'title'));
    }

    /**
     * Form tambah kuis baru.
     */
    public function create()
    {
        $kelas = Kelas::all();
        $title = 'Tambah Kuis';

        return view('pages.kuis.create', compact('kelas', 'title'));
    }

    /**
     * Simpan kuis ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_kuis' => 'required|string|max:255',
            'topik' => 'nullable|string|max:255',
            'kelas_id' => 'required|exists:kelas,id_kelas',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan Kuis Baru
        $kuis = Kuis::create($request->all());

        // Redirect langsung ke halaman kelola soal (show) agar guru bisa langsung bikin soalnya
        return redirect()->route('kuis.show', $kuis->id)
            ->with('success', 'Kuis berhasil dibuat. Silakan tambahkan langkah-langkah soal.');
    }

    /**
     * Halaman detail kuis sekaligus TEMPAT MENGELOLA SOAL.
     */
    public function show(Kuis $kui) // Parameter $kui karena route resource defaultnya singular
    {
        // Kita load relasi 'soal' agar bisa ditampilkan daftarnya
        $kui->load(['soal' => function ($query) {
            $query->orderBy('urutan_benar', 'asc');
        }]);

        $title = 'Kelola Soal';

        // Kita kirim data kuis ke view
        return view('pages.kuis.show', compact('kui', 'title'));
    }

    /**
     * Form edit kuis.
     */
    public function edit(Kuis $kui)
    {
        $kelas = Kelas::all();
        $title = 'Edit Kuis';

        return view('pages.kuis.edit', compact('kui', 'kelas', 'title'));
    }

    /**
     * Update kuis.
     */
    public function update(Request $request, Kuis $kui)
    {
        $request->validate([
            'judul_kuis' => 'required|string|max:255',
            'topik' => 'nullable|string|max:255',
            'kelas_id' => 'required|exists:kelas,id_kelas',
        ]);

        $kui->update($request->all());

        return redirect()->route('kuis.index')
            ->with('success', 'Informasi kuis berhasil diperbarui.');
    }

    /**
     * Hapus kuis.
     */
    public function destroy(Kuis $kui)
    {
        $kui->delete();
        return redirect()->route('kuis.index')
            ->with('success', 'Kuis berhasil dihapus.');
    }
}
