<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\SoalKuisController;
use App\Http\Controllers\SiswaKuisController;
use App\Http\Controllers\SiswaMateriController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Login Siswa
Route::middleware('guest:siswa')->group(function () {
    Route::get('/siswa/login', [SiswaAuthController::class, 'showLoginForm'])->name('siswa.login');
    Route::post('/siswa/login', [SiswaAuthController::class, 'login']);
});

//Dashboard Siswa
Route::middleware('auth:siswa')->group(function () {
    Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');
    Route::get('/siswa/dashboard', function () {
        return view('pages.siswa.dashboard');
    })->name('siswa.dashboard');
});

//Dashboard
Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware('auth')->name('dashboard');

//Kelas
Route::resource('kelas', KelasController::class)->middleware('auth');

//Manajemen Siswa
Route::resource('siswas', SiswaController::class)->middleware('auth');
Route::get('/kelas/{kelas}/siswa', [KelasController::class, 'showSiswa'])->name('kelas.siswa.index');

//Manajemen Materi
Route::resource('materi', MateriController::class)->middleware('auth');
Route::get('/kelas/{kelas}/materi', [KelasController::class, 'showMateri'])->name('kelas.materi.index');

//Manajemen Soal
Route::resource('kuis', KuisController::class)->middleware('auth');
Route::post('/soal-kuis', [SoalKuisController::class, 'store'])->name('soal.store')->middleware('auth');
Route::delete('/soal-kuis/{id}', [SoalKuisController::class, 'destroy'])->name('soal.destroy')->middleware('auth');

//Kuis Siswa
Route::middleware('auth:siswa')->group(function () {
    Route::get('/siswa/latihan-soal', [SiswaKuisController::class, 'index'])->name('siswa.kuis.index');
    Route::get('/siswa/kuis/{id}/kerjakan', [SiswaKuisController::class, 'kerjakan'])->name('siswa.kuis.kerjakan');
    Route::post('/siswa/kuis/{id}/submit', [SiswaKuisController::class, 'submit'])->name('siswa.kuis.submit');
    Route::get('/siswa/kuis/{id}/hasil', [SiswaKuisController::class, 'hasil'])->name('siswa.kuis.hasil');
    Route::get('/siswa/materi', [SiswaMateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('/siswa/materi/{id}', [SiswaMateriController::class, 'show'])->name('siswa.materi.show');
});

