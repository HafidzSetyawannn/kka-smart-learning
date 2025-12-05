<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $dataKelas = Kelas::latest()->paginate(10);
        $title = 'Data Kelas';
        return view('pages.kelas.index', compact('dataKelas'));


    }

    public function create()
    {
        $title = 'Tambah Kelas Baru';
        return view('pages.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'nama_guru' => 'required|string|max:255',
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.')
            ->with('alert-type', 'success');
    }

    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $title = 'Edit Kelas';
        return view('pages.kelas.edit', compact('kelas'));
    }

    public function showSiswa(Kelas $kelas)
    {
        $siswas = $kelas->siswas()->paginate(10);
        $title = 'Daftar Siswa - ' . $kelas->nama_kelas;
        return view('pages.kelas.siswa', compact('kelas', 'siswas'));
    }

    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'nama_guru' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.')
            ->with('alert-type', 'secondary');
    }

    public function destroy($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->delete();
        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.')
            ->with('alert-type', 'danger');
    }

    public function showMateri(Kelas $kelas)
    {
        $materis = $kelas->materi()->latest()->paginate(10);

        $title = 'Daftar Materi';

        return view('pages.materi.index', compact('kelas', 'materis', 'title'));
    }
}
