<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::with('kelas')->latest()->paginate(10);

        $title = 'Manajemen Materi';

        return view('pages.materi.index', compact('materis', 'title'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $title = 'Tambah Materi';

        return view('pages.materi.create', compact('kelas', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id_kelas',
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:video,gambar,pdf,youtube', // Ada youtube
            // Validasi Kondisional
            'file_materi' => 'required_if:tipe,video,gambar,pdf|file|max:51200',
            'link_youtube' => 'required_if:tipe,youtube|nullable|url',
        ]);

        $data = $request->all();

        // 1. Jika Upload File
        if ($request->hasFile('file_materi')) {
            $data['file_path'] = $request->file('file_materi')->store('materi', 'public');
        }

        // 2. Jika Youtube, pastikan file_path null
        if ($request->tipe == 'youtube') {
            $data['file_path'] = null;
        }

        Materi::create($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        $title = 'Detail Materi';
        return view('pages.materi.show', compact('materi', 'title'));
    }

    public function edit(Materi $materi)
    {
        $kelas = Kelas::all();
        $title = 'Edit Materi';

        return view('pages.materi.edit', compact('materi', 'kelas', 'title'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:video,gambar,pdf,youtube',
            'file_materi' => 'nullable|file|max:51200',
            'link_youtube' => 'required_if:tipe,youtube|nullable|url',
        ]);

        $data = $request->all();

        // Cek Tipe Baru
        if ($request->tipe == 'youtube') {
            // Jika ganti ke YouTube, hapus file lama jika ada
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $data['file_path'] = null;
        } else {
            // Jika Tipe File (Video/Gambar/PDF)
            if ($request->hasFile('file_materi')) {
                if ($materi->file_path) {
                    Storage::disk('public')->delete($materi->file_path);
                }
                $data['file_path'] = $request->file('file_materi')->store('materi', 'public');
            }
            // Kosongkan link youtube
            $data['link_youtube'] = null;
        }

        $materi->update($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
