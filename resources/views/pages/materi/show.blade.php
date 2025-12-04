@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Detail Materi</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-2 d-flex align-items-center justify-content-center bg-light"
                                    style="height: 350px; overflow: hidden; background-color: #f8f9fa;">

                                    @if ($materi->tipe == 'video')
                                        <video controls class="rounded"
                                            style="height: 100%; width: 100%; object-fit: contain;">
                                            <source src="{{ asset('storage/' . $materi->file_path) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @elseif($materi->tipe == 'gambar')
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal"
                                            style="cursor: zoom-in;">
                                            <img src="{{ asset('storage/' . $materi->file_path) }}" class="rounded"
                                                style="height: 100%; width: 100%; object-fit: contain;"
                                                alt="{{ $materi->judul }}" title="Klik untuk memperbesar">
                                        </a>
                                    @elseif($materi->tipe == 'pdf')
                                        <div class="text-center">
                                            <i class="fa fa-file-pdf fa-5x text-danger mb-3"></i>
                                            <h5 class="mb-2">Dokumen PDF</h5>
                                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                                class="btn btn-primary mb-0">
                                                <i class="fa fa-download me-2"></i> Lihat / Download
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <i class="fa fa-align-left fa-5x text-secondary mb-3"></i>
                                            <h5 class="mb-1">Materi Teks</h5>
                                            <p class="text-sm text-muted mb-0">Isi materi dapat dibaca di bagian bawah.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Judul Materi</label>
                                            <input class="form-control" type="text" value="{{ $materi->judul }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Topik</label>
                                            <input class="form-control" type="text" value="{{ $materi->topik ?? '-' }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Tipe</label>
                                            <input class="form-control text-uppercase" type="text"
                                                value="{{ $materi->tipe }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-control-label">Kelas</label>
                                            <input class="form-control" type="text"
                                                value="{{ $materi->kelas->nama_kelas }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label class="form-control-label">Dibuat Oleh</label>
                                            <input class="form-control" type="text"
                                                value="{{ $materi->kelas->nama_guru }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($materi->tipe == 'teks')
                            <hr class="horizontal dark my-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Isi Materi Pembelajaran</label>
                                        <div class="p-4 border rounded bg-gray-100 text-dark"
                                            style="white-space: pre-line; min-height: 200px; line-height: 1.6;">
                                            {{ $materi->isi }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('materi.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                            <a href="{{ route('materi.edit', $materi->id) }}" class="btn bg-gradient-primary">Edit
                                Materi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($materi->tipe == 'gambar')
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0 shadow-none">
                    <div class="modal-body p-0 position-relative text-center">
                        <button type="button"
                            class="btn-close btn-close-white position-absolute top-0 end-0 m-3 bg-dark rounded-circle p-2"
                            data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.8;"></button>
                        <img src="{{ asset('storage/' . $materi->file_path) }}" class="img-fluid rounded shadow-lg"
                            alt="{{ $materi->judul }}" style="max-height: 90vh;">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
