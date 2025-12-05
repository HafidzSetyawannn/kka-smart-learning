@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Materi Pembelajaran (Kelas {{ Auth::guard('siswa')->user()->kelas->nama_kelas }})</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            @forelse($materis as $materi)
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card h-100 card-frame border shadow-sm">

                                        {{-- Preview Gambar/Ikon berdasarkan tipe --}}
                                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                            <a href="{{ route('siswa.materi.show', $materi->id) }}" class="d-block">
                                                @if ($materi->tipe == 'gambar' || $materi->tipe == 'video')
                                                    {{-- Tampilkan thumbnail jika video/gambar (bisa pakai file itu sendiri) --}}
                                                    <div style="height: 160px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; overflow: hidden;"
                                                        class="border-radius-lg">
                                                        @if ($materi->tipe == 'gambar')
                                                            <img src="{{ asset('storage/' . $materi->file_path) }}"
                                                                class="img-fluid"
                                                                style="object-fit: cover; height: 100%; width: 100%;">
                                                        @else
                                                            <i class="ni ni-button-play text-primary fa-3x"></i>
                                                        @endif
                                                    </div>
                                                @else
                                                    {{-- Ikon untuk PDF/Teks --}}
                                                    <div class="bg-gradient-light border-radius-lg py-5 text-center"
                                                        style="height: 160px;">
                                                        <i class="ni ni-books text-primary fa-3x"></i>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>

                                        <div class="card-body pt-3">
                                            {{-- Topik & Tipe --}}
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span
                                                    class="text-xs font-weight-bold text-uppercase text-primary">{{ $materi->topik ?? 'Umum' }}</span>
                                                <span
                                                    class="badge badge-sm bg-gradient-secondary">{{ strtoupper($materi->tipe) }}</span>
                                            </div>

                                            {{-- Judul --}}
                                            <a href="{{ route('siswa.materi.show', $materi->id) }}" class="text-dark">
                                                <h5 class="font-weight-bolder mb-2 text-truncate">{{ $materi->judul }}</h5>
                                            </a>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <span class="text-xs text-secondary">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{ $materi->created_at->diffForHumans() }}
                                                </span>
                                                <a href="{{ route('siswa.materi.show', $materi->id) }}"
                                                    class="btn btn-sm btn-outline-primary mb-0">
                                                    Buka Materi
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-light shadow text-center border-radius-lg mb-3">
                                        <i class="ni ni-books text-dark opacity-10"></i>
                                    </div>
                                    <h5>Belum ada materi tersedia</h5>
                                    <p class="text-secondary text-sm">Guru belum mengupload materi pembelajaran.</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Paginasi --}}
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $materis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
