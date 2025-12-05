<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')->latest()->paginate(10);
        return view('pages.siswa.index', compact('siswas'));
    }

    public function create(Request $request)
    {
        $allKelas = Kelas::all();

        $selectedKelas = null;
        if ($request->has('kelas_id')) {
            $selectedKelas = Kelas::find($request->query('kelas_id'));
        }

        return view('pages.siswa.create', [
            'allKelas' => $allKelas,
            'selectedKelas' => $selectedKelas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:siswa,nis',
            'no_absen' => 'required|integer',
            'kelas_id' => 'required|exists:kelas,id_kelas',
        ]);

        // Siapkan data
        $data = $request->all();

        // [PENTING] Set password default = NIS (di-hash)
        $data['password'] = Hash::make($request->nis);

        Siswa::create($data); // Simpan array $data yang sudah ada passwordnya

        return redirect()->route('kelas.siswa.index', $request->kelas_id)
            ->with('success', 'Data siswa berhasil ditambahkan. Password default adalah NIS.');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('pages.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => ['required', 'string', 'max:255', Rule::unique('siswa')->ignore($siswa->id)],
            'no_absen' => 'required|integer',
            'kelas_id' => 'required|exists:kelas,id_kelas',
        ]);

        $siswa->update($request->all());
        return redirect()->route('kelas.siswa.index', ['kelas' => $siswa->kelas_id])->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('kelas.siswa.index', ['kelas' => $siswa->kelas_id])->with('success', 'Data siswa berhasil dihapus.');
    }
}
