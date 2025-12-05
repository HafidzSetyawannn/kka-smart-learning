@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Daftar Latihan Soal (Kelas {{ Auth::guard('siswa')->user()->kelas->nama_kelas }})</h6>
                    </div>
                    <div class="card-body p-3">
                        {{-- Pesan Notifikasi --}}
                        @if (session('error'))
                            <div class="alert alert-danger text-white mb-3" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            @forelse($daftarKuis as $kuis)
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card h-100 card-frame border shadow-sm">
                                        <div class="card-body">
                                            {{-- Topik --}}
                                            <p class="text-xs mb-1 text-uppercase font-weight-bold text-primary">
                                                {{ $kuis->topik ?? 'Umum' }}
                                            </p>

                                            {{-- Judul Kuis --}}
                                            <h5 class="font-weight-bolder mb-2">{{ $kuis->judul_kuis }}</h5>

                                            {{-- Deskripsi Singkat --}}
                                            <p class="text-sm mb-3 text-secondary text-truncate">
                                                {{ Str::limit($kuis->deskripsi, 80) ?? 'Tidak ada instruksi khusus.' }}
                                            </p>

                                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                {{-- Badge Jumlah Soal --}}
                                                <span class="badge badge-sm bg-gradient-secondary">
                                                    {{ $kuis->soal_count }} Langkah
                                                </span>

                                                {{-- LOGIKA TOMBOL --}}
                                                @php
                                                    // Mengambil data nilai dari relasi
                                                    $nilai = $kuis->nilai_siswa;
                                                @endphp

                                                @if (!$nilai)
                                                    {{-- KONDISI 1: Belum pernah mengerjakan --}}
                                                    <a href="{{ route('siswa.kuis.kerjakan', $kuis->id) }}"
                                                        class="btn btn-sm bg-gradient-primary mb-0">
                                                        Mulai <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                @elseif($nilai->skor < 75)
                                                    {{-- KONDISI 2: Sudah mengerjakan tapi BELUM LULUS (Remedial) --}}
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-danger font-weight-bold text-sm me-3">
                                                            Nilai: {{ $nilai->skor }}
                                                        </span>
                                                        <a href="{{ route('siswa.kuis.kerjakan', $kuis->id) }}"
                                                            class="btn btn-sm btn-outline-warning mb-0"
                                                            data-bs-toggle="tooltip"
                                                            title="Nilai belum tuntas, silakan coba lagi.">
                                                            Ulangi <i class="fas fa-redo ms-1"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    {{-- KONDISI 3: SUDAH LULUS (>= 75) --}}
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-success font-weight-bold text-sm me-2">
                                                            <i class="fas fa-check-circle me-1"></i> Lulus
                                                            ({{ $nilai->skor }})
                                                        </span>
                                                        <button class="btn btn-sm bg-gradient-success mb-0" disabled
                                                            style="cursor: not-allowed; opacity: 0.6;">
                                                            Selesai
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-light shadow text-center border-radius-lg mb-3">
                                        <i class="ni ni-controller text-dark opacity-10"></i>
                                    </div>
                                    <h5>Belum ada kuis tersedia</h5>
                                    <p class="text-secondary text-sm">Guru belum menambahkan latihan soal untuk kelasmu.</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Paginasi --}}
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $daftarKuis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
