<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Dashboard
Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware('auth')->name('dashboard');

//Kelas
Route::resource('kelas', KelasController::class)->middleware('auth');

//Siswa
Route::resource('siswas', SiswaController::class)->middleware('auth');
Route::get('/kelas/{kelas}/siswa', [KelasController::class, 'showSiswa'])->name('kelas.siswa.index');
