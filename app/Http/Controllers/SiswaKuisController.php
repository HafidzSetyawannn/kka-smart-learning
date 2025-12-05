<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kuis;
use App\Models\SoalKuis;
use App\Models\NilaiKuis;

class SiswaKuisController extends Controller
{
    public function index()
    {
        // 1. Ambil data siswa yang sedang login
        $siswa = Auth::guard('siswa')->user();

        // 2. Ambil kuis yang HANYA untuk kelas siswa tersebut
        //    dan urutkan dari yang terbaru
        $daftarKuis = Kuis::where('kelas_id', $siswa->kelas_id)
            ->withCount('soal') // Hitung jumlah soal
            ->with('nilai_siswa') // Ambil nilai siswa jika ada
            ->latest()
            ->paginate(10);

        return view('pages.siswa.kuis.index', compact('daftarKuis'));
    }

    public function kerjakan($id)
    {
        // Cek dulu apakah siswa sudah lulus kuis ini
        $cekNilai = NilaiKuis::where('kuis_id', $id)
            ->where('siswa_id', Auth::guard('siswa')->id())
            ->latest()
            ->first();

        // Jika sudah pernah mengerjakan DAN nilainya >= 75
        if ($cekNilai && $cekNilai->skor >= 75) {
            return redirect()->route('siswa.kuis.index')
                ->with('error', 'Kamu sudah lulus kuis ini dengan nilai ' . $cekNilai->skor);
        }

        // ... (kode pengambilan soal acak yang lama tetap di sini) ...
        $kuis = Kuis::with('soal')->findOrFail($id);
        $soalAcak = $kuis->soal->shuffle();

        return view('pages.siswa.kuis.kerjakan', compact('kuis', 'soalAcak'));
    }

    public function submit(Request $request, $id)
    {
        // 1. Ambil ID soal yang dikirim siswa (Format JSON String -> Array)
        // Contoh input: "[5, 2, 1, 4]" (Ini adalah urutan ID soal versi siswa)
        $urutanSiswa = json_decode($request->jawaban_siswa);

        // 2. Ambil Kunci Jawaban Benar dari Database
        // Kita ambil ID soal saja, diurutkan berdasarkan 'urutan_benar' (1, 2, 3...)
        $kunciJawaban = SoalKuis::where('kuis_id', $id)
            ->orderBy('urutan_benar', 'asc')
            ->pluck('id')
            ->toArray();

        // 3. Logika Penilaian (Matching)
        $totalSoal = count($kunciJawaban);
        $jawabanBenar = 0;

        if ($totalSoal > 0 && count($urutanSiswa) == $totalSoal) {
            foreach ($urutanSiswa as $index => $soalId) {
                // Cek apakah ID soal pada index ke-i sama dengan kunci jawaban pada index ke-i
                if ($soalId == $kunciJawaban[$index]) {
                    $jawabanBenar++;
                }
            }

            // Hitung Skor (Skala 100)
            $skor = ($jawabanBenar / $totalSoal) * 100;
        } else {
            $skor = 0; // Jika data error/kosong
        }

        // 4. Simpan Nilai ke Database
        NilaiKuis::create([
            'siswa_id' => Auth::guard('siswa')->id(),
            'kuis_id'  => $id,
            'skor'     => round($skor), // Bulatkan nilai
        ]);

        // 5. Redirect ke halaman hasil (kita buat sebentar lagi)
        return redirect()->route('siswa.kuis.hasil', [
            'id' => $id,
            'skor' => round($skor)
        ]);
    }

    /**
     * Menampilkan Halaman Hasil
     */
    public function hasil($id, Request $request)
    {
        $kuis = Kuis::findOrFail($id);
        $skor = $request->query('skor');

        return view('pages.siswa.kuis.hasil', compact('kuis', 'skor'));
    }
}
