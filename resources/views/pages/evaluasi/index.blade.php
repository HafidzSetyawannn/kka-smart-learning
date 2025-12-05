@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Pilih Kelas untuk Evaluasi</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            @foreach ($kelas as $k)
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card h-100 card-frame border shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="ni ni-hat-3 text-primary fa-3x mb-3"></i>
                                            <h5 class="mb-1">{{ $k->nama_kelas }}</h5>
                                            <p class="text-sm text-secondary">{{ $k->siswas_count }} Siswa</p>
                                            <a href="{{ route('evaluasi.show', $k->id_kelas) }}"
                                                class="btn bg-gradient-primary btn-sm w-100 mt-2">
                                                Lihat Analisis
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
