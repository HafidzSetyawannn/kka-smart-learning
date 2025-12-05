@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- BAGIAN 1: BANNER SELAMAT DATANG --}}
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-gradient-primary shadow-lg overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="text-white mb-2">Halo, {{ Auth::guard('siswa')->user()->nama_siswa }}! 👋</h3>
                            <p class="text-white opacity-8 mb-4">
                                Selamat datang kembali di kelas <strong>{{ Auth::guard('siswa')->user()->kelas->nama_kelas }}</strong>.
                                <br>
                                Status kamu saat ini: <span class="badge bg-white text-primary">{{ $badge['name'] }}</span>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('siswa.materi.index') }}" class="btn btn-sm btn-white mb-0 text-primary">
                                    <i class="ni ni-book-bookmark me-1"></i> Mulai Belajar
                                </a>
                                <a href="{{ route('siswa.kuis.index') }}" class="btn btn-sm btn-outline-white mb-0">
                                    <i class="ni ni-controller me-1"></i> Latihan Soal
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end d-none d-lg-block">
                            <i class="ni ni-hat-3 text-white opacity-2" style="font-size: 8rem; position: absolute; right: 20px; bottom: -20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BAGIAN 2: STATISTIK BELAJAR (PROGRES) --}}
    <div class="row mb-4">
        {{-- Kartu Rata-rata Nilai --}}
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-secondary">Rata-rata Nilai</p>
                                <h3 class="font-weight-bolder {{ $rataRata >= 75 ? 'text-success' : 'text-primary' }}">
                                    {{ $rataRata }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-{{ $badge['color'] }} shadow-{{ $badge['color'] }} text-center rounded-circle">
                                <i class="ni ni-trophy text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm mb-0 mt-2">
                        <span class="text-success text-sm font-weight-bolder">Semangat!</span> Tingkatkan terus nilaimu.
                    </p>
                </div>
            </div>
        </div>

        {{-- Kartu Kuis Selesai --}}
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-secondary">Kuis Diselesaikan</p>
                                <h3 class="font-weight-bolder text-dark">
                                    {{ $kuisSelesai }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-controller text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm mb-0 mt-2">
                        Latihan membuatmu makin jago logikanya.
                    </p>
                </div>
            </div>
        </div>

        {{-- Kartu Materi --}}
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-secondary">Materi Tersedia</p>
                                <h3 class="font-weight-bolder text-info">
                                    {{ $totalMateri }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm mb-0 mt-2">
                        Pelajari materi baru setiap hari.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- BAGIAN 3: CARD NAVIGASI CEPAT (Optional, jika masih ingin ada tombol besar) --}}
    <div class="row">
        <div class="col-12">
            <div class="card card-plain">
                <div class="card-header pb-3 text-start">
                    <h6 class="font-weight-bolder">Aksi Cepat</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('siswa.materi.index') }}">
                                <div class="card card-frame border-primary h-100 btn btn-outline-white w-100 d-flex align-items-center p-3">
                                    <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
                                        <i class="ni ni-book-bookmark text-white opacity-10"></i>
                                    </div>
                                    <div class="text-start">
                                        <h6 class="mb-0 text-dark">Lihat Materi Pelajaran</h6>
                                        <span class="text-xs text-secondary">Buka video dan modul belajar</span>
                                    </div>
                                    <i class="fas fa-arrow-right ms-auto text-primary"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('siswa.kuis.index') }}">
                                <div class="card card-frame border-warning h-100 btn btn-outline-white w-100 d-flex align-items-center p-3">
                                    <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center border-radius-md me-3">
                                        <i class="ni ni-controller text-white opacity-10"></i>
                                    </div>
                                    <div class="text-start">
                                        <h6 class="mb-0 text-dark">Kerjakan Latihan Soal</h6>
                                        <span class="text-xs text-secondary">Asah kemampuan logikamu</span>
                                    </div>
                                    <i class="fas fa-arrow-right ms-auto text-warning"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
