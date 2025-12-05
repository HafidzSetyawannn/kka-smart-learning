<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Kuis;

class EvaluasiController extends Controller
{
    /**
     * Halaman awal: Pilih Kelas untuk dievaluasi
     */
    public function index()
    {
        $kelas = Kelas::withCount('siswas')->get();
        $title = 'Evaluasi Siswa';
        return view('pages.evaluasi.index', compact('kelas', 'title'));
    }

    /**
     * Halaman Detail: Tabel Analisis per Kelas
     */
    public function show(Kelas $kelas)
    {
        $title = 'Evaluasi Kelas: ' . $kelas->nama_kelas;

        // Hanya ambil data siswa, tidak perlu hitung nilai di sini agar loading cepat
        $siswas = Siswa::where('kelas_id', $kelas->id_kelas)->orderBy('nama_siswa')->get();

        return view('pages.evaluasi.show', compact('kelas', 'siswas', 'title'));
    }

    /**
     * [BARU] Halaman Detail Rapor & Analisis per Siswa
     */
    public function detailSiswa(Siswa $siswa)
    {
        $title = 'Rapor Evaluasi: ' . $siswa->nama_siswa;

        // Ambil semua kuis yang tersedia untuk kelas siswa ini
        $daftarKuis = Kuis::where('kelas_id', $siswa->kelas_id)->get();

        // Ambil nilai-nilai siswa ini
        $siswa->load('nilai_kuis');

        // --- LOGIKA ANALISIS (Dipindah ke sini) ---
        $totalNilai = 0;
        $topikLemah = [];
        $hasilDetail = []; // Untuk menampung data tabel detail

        foreach ($daftarKuis as $kuis) {
            $nilai = $siswa->nilai_kuis->where('kuis_id', $kuis->id)->first();
            $skor = $nilai ? $nilai->skor : 0;

            if ($nilai) {
                $totalNilai += $skor;
                // Deteksi kelemahan
                if ($skor < 75) {
                    $topikLemah[] = $kuis->topik;
                }
            }

            $hasilDetail[] = [
                'kuis' => $kuis->judul_kuis,
                'topik' => $kuis->topik,
                'skor' => $nilai ? $skor : '-',
                'status' => $nilai ? ($skor >= 75 ? 'Tuntas' : 'Remedial') : 'Belum Dikerjakan',
                'tanggal' => $nilai ? $nilai->created_at->format('d M Y') : '-'
            ];
        }

        // Hitung Rata-rata
        $rataRata = $daftarKuis->count() > 0 ? round($totalNilai / $daftarKuis->count()) : 0;

        // Tentukan Predikat
        if ($rataRata >= 85) {
            $predikat = 'Sangat Paham';
            $warna = 'success';
        } elseif ($rataRata >= 75) {
            $predikat = 'Paham';
            $warna = 'info';
        } else {
            $predikat = 'Butuh Bimbingan';
            $warna = 'danger';
        }

        // Rekomendasi
        $rekomendasi = count($topikLemah) > 0
            ? 'Siswa perlu pendalaman materi pada topik: ' . implode(', ', array_unique($topikLemah))
            : 'Pemahaman konsep sangat baik. Pertahankan!';

        return view('pages.evaluasi.detail_siswa', compact('siswa', 'hasilDetail', 'rataRata', 'predikat', 'warna', 'rekomendasi', 'title'));
    }
}
