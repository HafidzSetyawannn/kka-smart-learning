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
            'topik' => 'nullable|string|max:255',
            'tipe' => 'required|in:video,gambar,pdf',
            'file_materi' => 'required|file|max:51200',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_materi')) {
            $path = $request->file('file_materi')->store('materi', 'public');
            $data['file_path'] = $path;
        }

        Materi::create($data);

        return redirect()->route('materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
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
            'kelas_id' => 'required|exists:kelas,id_kelas',
            'judul' => 'required|string|max:255',
            'topik' => 'nullable|string|max:255',
            'tipe' => 'required|in:video,gambar,pdf',
            'file_materi' => 'nullable|file|max:51200',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_materi')) {
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $path = $request->file('file_materi')->store('materi', 'public');
            $data['file_path'] = $path;
        }

        $materi->update($data);

        return redirect()->route('materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
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
