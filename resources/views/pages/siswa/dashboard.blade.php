@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-1">Selamat Datang, {{ Auth::guard('siswa')->user()->nama_siswa }}! 👋</h4>
                            <p class="text-sm mb-0">
                                Kelas: <strong>{{ Auth::guard('siswa')->user()->kelas->nama_kelas }}</strong> |
                                NIS: {{ Auth::guard('siswa')->user()->nis }}
                            </p>
                            <p class="mt-3 text-muted">
                                Semangat belajar hari ini! Silakan pilih materi atau kuis yang ingin kamu kerjakan dari menu di samping.
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            {{-- Ilustrasi atau Ikon Pemanis --}}
                            <i class="ni ni-hat-3 text-primary opacity-5" style="font-size: 5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Card Pintas ke Materi --}}
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Materi Pembelajaran</p>
                                <h5 class="font-weight-bolder mt-2">Lihat Materi</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Pintas ke Kuis --}}
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tugas & Kuis</p>
                                <h5 class="font-weight-bolder mt-2">Mulai Kuis</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-controller text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
