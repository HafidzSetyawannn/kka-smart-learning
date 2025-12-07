@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Detail Materi</h6>
                        <span class="badge bg-gradient-info text-uppercase">{{ $materi->tipe }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- BAGIAN KIRI: Media Player / Preview --}}
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-2 d-flex align-items-center justify-content-center bg-light" style="height: 350px; overflow: hidden; background-color: #f8f9fa;">

                                {{-- 1. LOGIKA VIDEO (YOUTUBE vs UPLOAD) --}}
                                @if($materi->tipe == 'video' || $materi->tipe == 'youtube')

                                    @if($materi->link_youtube)
                                        {{-- JIKA LINK YOUTUBE: Tampilkan Tombol --}}
                                        <div class="text-center p-4">
                                            <i class="fab fa-youtube fa-5x text-danger mb-3" style="font-size: 5rem;"></i>
                                            <h5 class="mb-2">Video Pembelajaran</h5>
                                            <p class="text-sm text-muted mb-3">
                                                Video ini bersumber dari YouTube. Klik tombol di bawah untuk menonton.
                                            </p>
                                            <a href="{{ $materi->link_youtube }}" target="_blank" class="btn bg-gradient-danger mb-0">
                                                <i class="fas fa-play me-2"></i> Tonton di YouTube
                                            </a>
                                        </div>

                                    @elseif($materi->file_path)
                                        {{-- JIKA FILE UPLOAD: Tampilkan Player Lokal --}}
                                        <video controls class="rounded" style="height: 100%; width: 100%; object-fit: contain;">
                                            <source src="{{ asset('storage/' . $materi->file_path) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @else
                                        <div class="text-center text-muted">File video tidak ditemukan.</div>
                                    @endif

                                {{-- 2. Tampilan GAMBAR --}}
                                @elseif($materi->tipe == 'gambar' && $materi->file_path)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor: zoom-in; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('storage/' . $materi->file_path) }}" class="rounded" style="height: 100%; width: 100%; object-fit: contain;" alt="{{ $materi->judul }}">
                                    </a>

                                {{-- 3. Tampilan PDF --}}
                                @elseif($materi->tipe == 'pdf' && $materi->file_path)
                                    <div class="text-center">
                                        <i class="fa fa-file-pdf fa-5x text-danger mb-3"></i>
                                        <h5 class="mb-2">Dokumen PDF</h5>
                                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="btn btn-primary mb-0">
                                            <i class="fa fa-download me-2"></i> Lihat / Download
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{-- BAGIAN KANAN: Informasi Detail (TIDAK BERUBAH) --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label text-secondary text-xs font-weight-bold">Judul Materi</label>
                                        <div class="form-control bg-white">{{ $materi->judul }}</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label text-secondary text-xs font-weight-bold">Topik</label>
                                        <div class="form-control bg-white">{{ $materi->topik ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label text-secondary text-xs font-weight-bold">Tipe</label>
                                        <div class="form-control bg-white text-uppercase">{{ $materi->tipe }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label text-secondary text-xs font-weight-bold">Kelas</label>
                                        <div class="form-control bg-white">{{ $materi->kelas->nama_kelas }}</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label class="form-control-label text-secondary text-xs font-weight-bold">Dibuat Oleh</label>
                                        <div class="form-control bg-white">{{ $materi->kelas->nama_guru }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4 gap-2">
                                <a href="{{ route('materi.index') }}" class="btn btn-outline-secondary mb-0 me-2">
                                    <i class="fa fa-arrow-left me-1"></i> Kembali
                                </a>
                                <a href="{{ route('materi.edit', $materi->id) }}" class="btn bg-gradient-primary mb-0">
                                    <i class="fa fa-pen me-1"></i> Edit Materi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL ZOOM GAMBAR --}}
@if($materi->tipe == 'gambar' && $materi->file_path)
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-body p-0 position-relative text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 bg-dark rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.8;"></button>
                <img src="{{ asset('storage/' . $materi->file_path) }}" class="img-fluid rounded shadow-lg" alt="{{ $materi->judul }}" style="max-height: 90vh;">
            </div>
        </div>
    </div>
</div>
@endif

@endsection
