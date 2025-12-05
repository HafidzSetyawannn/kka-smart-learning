@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-0">{{ $materi->judul }}</h5>
                                <p class="text-sm text-secondary mb-0">{{ $materi->topik }}</p>
                            </div>
                            <span class="badge bg-gradient-info align-self-start">{{ strtoupper($materi->tipe) }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- TAMPILAN KONTEN --}}
                        <div class="border rounded p-3 mb-4 bg-light text-center" style="min-height: 300px;">

                            @if ($materi->tipe == 'video')
                                <div class="ratio ratio-16x9">
                                    <video controls class="rounded">
                                        <source src="{{ asset('storage/' . $materi->file_path) }}" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                </div>
                            @elseif($materi->tipe == 'gambar')
                                <img src="{{ asset('storage/' . $materi->file_path) }}" class="img-fluid rounded shadow-sm"
                                    alt="{{ $materi->judul }}">
                            @elseif($materi->tipe == 'pdf')
                                <div class="py-5">
                                    <i class="fa fa-file-pdf fa-4x text-danger mb-3"></i>
                                    <h5>Dokumen PDF</h5>
                                    <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                        class="btn btn-primary mt-2">
                                        <i class="fa fa-download me-2"></i> Baca / Download PDF
                                    </a>
                                </div>
                            @elseif($materi->tipe == 'teks')
                                <div class="text-start bg-white p-4 border rounded text-dark"
                                    style="white-space: pre-line; font-size: 1.1em; line-height: 1.8;">
                                    {{ $materi->isi }}
                                </div>
                            @endif
                        </div>

                        <hr class="horizontal dark">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('siswa.materi.index') }}" class="btn btn-outline-secondary mb-0">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <p class="text-xs text-secondary mb-0">
                                Dibuat oleh: <strong>{{ $materi->kelas->nama_guru }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
