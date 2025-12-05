<?php

namespace App\Http\Controllers;

use App\Models\SoalKuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoalKuisController extends Controller
{
    /**
     * Menyimpan langkah soal baru ke dalam kuis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kuis_id' => 'required|exists:kuis,id',
            'teks_langkah' => 'required|string',
            'urutan_benar' => 'required|integer',
            'gambar_langkah' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('gambar_langkah')) {
            $data['gambar_langkah'] = $request->file('gambar_langkah')->store('soal', 'public');
        }

        SoalKuis::create($data);

        // Kembali ke halaman kelola soal (kuis.show)
        return redirect()->route('kuis.show', $request->kuis_id)
            ->with('success', 'Langkah berhasil ditambahkan.');
    }

    /**
     * Menghapus langkah soal.
     */
    public function destroy($id)
    {
        $soal = SoalKuis::findOrFail($id);
        $kuisId = $soal->kuis_id;

        // Hapus gambar jika ada
        if ($soal->gambar_langkah) {
            Storage::disk('public')->delete($soal->gambar_langkah);
        }

        $soal->delete();

        return redirect()->route('kuis.show', $kuisId)
            ->with('success', 'Langkah berhasil dihapus.');
    }
}
