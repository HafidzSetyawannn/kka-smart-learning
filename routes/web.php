<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\SoalKuisController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\SiswaKuisController;
use App\Http\Controllers\SiswaMateriController;


use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Kuis;
use App\Models\NilaiKuis;

//Halaman Welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');



// 1. Login Guru (Web Guard)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 2. Login Siswa (Siswa Guard)
Route::middleware('guest:siswa')->group(function () {
    Route::get('/siswa/login', [SiswaAuthController::class, 'showLoginForm'])->name('siswa.login');
    Route::post('/siswa/login', [SiswaAuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    // Logout Guru
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Guru (Dengan Logika Statistik & Aktivitas)
    Route::get('/dashboard', function () {
        $jumlahKelas  = Kelas::count();
        $jumlahSiswa  = Siswa::count();
        $jumlahMateri = Materi::count();
        $jumlahKuis   = Kuis::count();

        // Aktivitas Terbaru: Materi
        $recentMateri = Materi::with('kelas')->latest()->take(3)->get()->map(function ($item) {
            return [
                'type' => 'materi',
                'icon' => 'ni-book-bookmark',
                'color' => 'success',
                'title' => 'Materi Baru: ' . $item->judul,
                'desc'  => 'Ditambahkan ke kelas ' . $item->kelas->nama_kelas,
                'time'  => $item->created_at
            ];
        });

        // Aktivitas Terbaru: Kuis
        $recentKuis = Kuis::with('kelas')->latest()->take(3)->get()->map(function ($item) {
            return [
                'type' => 'kuis',
                'icon' => 'ni-controller',
                'color' => 'warning',
                'title' => 'Kuis Baru: ' . $item->judul_kuis,
                'desc'  => 'Topik: ' . ($item->topik ?? '-'),
                'time'  => $item->created_at
            ];
        });

        // Aktivitas Terbaru: Siswa
        $recentSiswa = Siswa::with('kelas')->latest()->take(3)->get()->map(function ($item) {
            return [
                'type' => 'siswa',
                'icon' => 'ni-hat-3',
                'color' => 'danger',
                'title' => 'Siswa Baru: ' . $item->nama_siswa,
                'desc'  => 'Bergabung di kelas ' . $item->kelas->nama_kelas,
                'time'  => $item->created_at
            ];
        });
        $activities = $recentMateri->concat($recentKuis)->concat($recentSiswa)->sortByDesc('time')->take(6);
        $title = 'Dashboard';

        return view('pages.dashboard.index', compact('jumlahKelas', 'jumlahSiswa', 'jumlahMateri', 'jumlahKuis', 'activities', 'title'));
    })->name('dashboard');

    // Profil Guru
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');

    // Manajemen Kelas
    Route::resource('kelas', KelasController::class);

    // Manajemen Siswa
    Route::resource('siswas', SiswaController::class);

    // Route khusus lihat siswa per kelas (dari menu detail kelas)
    Route::get('/kelas/{kelas}/siswa', [KelasController::class, 'showSiswa'])->name('kelas.siswa.index');

    // Manajemen Materi
    Route::resource('materi', MateriController::class);

    // Route khusus lihat materi per kelas (dari menu detail kelas)
    Route::get('/kelas/{kelas}/materi', [KelasController::class, 'showMateri'])->name('kelas.materi.index');

    // Manajemen Kuis & Soal
    Route::resource('kuis', KuisController::class);

    // Route khusus untuk menambah/menghapus butir soal (langkah)
    Route::post('/soal-kuis', [SoalKuisController::class, 'store'])->name('soal.store');
    Route::delete('/soal-kuis/{id}', [SoalKuisController::class, 'destroy'])->name('soal.destroy');

    // Evaluasi Siswa
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::get('/evaluasi/{kelas}', [EvaluasiController::class, 'show'])->name('evaluasi.show');
    Route::get('/evaluasi/siswa/{siswa}', [EvaluasiController::class, 'detailSiswa'])->name('evaluasi.detail_siswa');
});

Route::middleware('auth:siswa')->group(function () {

    // Logout Siswa
    Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

    // Dashboard Siswa
    Route::get('/siswa/dashboard', function () {
        $siswa = Auth::guard('siswa')->user();

        // 1. Ambil data statistik
        $totalMateri = \App\Models\Materi::where('kelas_id', $siswa->kelas_id)->count();
        $kuisSelesai = \App\Models\NilaiKuis::where('siswa_id', $siswa->id)->count();
        $rataRata    = \App\Models\NilaiKuis::where('siswa_id', $siswa->id)->avg('skor');
        $rataRata    = round($rataRata ?? 0);

        // 2. Tentukan Badge/Julukan berdasarkan rata-rata nilai
        if ($rataRata >= 90) {
            $badge = ['name' => 'Master Koding 🏆', 'color' => 'warning'];
        } elseif ($rataRata >= 75) {
            $badge = ['name' => 'Siswa Rajin 🌟', 'color' => 'success'];
        } elseif ($rataRata > 0) {
            $badge = ['name' => 'Pemula Semangat 🚀', 'color' => 'info'];
        } else {
            $badge = ['name' => 'Pendatang Baru 👋', 'color' => 'secondary'];
        }
        $title = 'Dashboard Siswa';

        return view('pages.siswa.dashboard', compact('title', 'totalMateri', 'kuisSelesai', 'rataRata', 'badge'));
    })->name('siswa.dashboard');

    // Profil Siswa
    Route::get('/siswa/profil', [ProfileController::class, 'edit'])->name('siswa.profile.edit');
    Route::put('/siswa/profil', [ProfileController::class, 'update'])->name('siswa.profile.update');

    // Materi Belajar Siswa
    Route::get('/siswa/materi', [SiswaMateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('/siswa/materi/{id}', [SiswaMateriController::class, 'show'])->name('siswa.materi.show');

    // Latihan Soal & Kuis Siswa
    Route::get('/siswa/latihan-soal', [SiswaKuisController::class, 'index'])->name('siswa.kuis.index');
    Route::get('/siswa/kuis/{id}/kerjakan', [SiswaKuisController::class, 'kerjakan'])->name('siswa.kuis.kerjakan');
    Route::post('/siswa/kuis/{id}/submit', [SiswaKuisController::class, 'submit'])->name('siswa.kuis.submit');
    Route::get('/siswa/kuis/{id}/hasil', [SiswaKuisController::class, 'hasil'])->name('siswa.kuis.hasil');
});
