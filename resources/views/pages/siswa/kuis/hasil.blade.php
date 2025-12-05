@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header pb-0">
                    <h6>Hasil Pengerjaan</h6>
                </div>
                <div class="card-body">
                    <h3 class="font-weight-bolder mb-1">{{ $kuis->judul_kuis }}</h3>
                    <p class="text-secondary text-sm mb-4">Topik: {{ $kuis->topik }}</p>

                    {{-- Tampilan Skor --}}
                    <div class="py-4">
                        @if($skor >= 70)
                            <div class="icon icon-shape icon-xl bg-gradient-success shadow-success text-center rounded-circle mb-3">
                                <i class="ni ni-trophy text-white opacity-10" style="font-size: 2rem;"></i>
                            </div>
                            <h2 class="text-success">Nilai Kamu: {{ $skor }}</h2>
                            <p class="text-sm">Luar biasa! Kamu berhasil menyusun algoritma dengan benar.</p>
                        @else
                            <div class="icon icon-shape icon-xl bg-gradient-warning shadow-warning text-center rounded-circle mb-3">
                                <i class="ni ni-bulb-61 text-white opacity-10" style="font-size: 2rem;"></i>
                            </div>
                            <h2 class="text-warning">Nilai Kamu: {{ $skor }}</h2>
                            <p class="text-sm">Tetap semangat! Coba pelajari lagi materinya dan ulangi kuis ini.</p>
                        @endif
                    </div>

                    <hr class="horizontal dark">

                    <a href="{{ route('siswa.kuis.index') }}" class="btn bg-gradient-dark w-100 mb-0">
                        Kembali ke Daftar Latihan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
