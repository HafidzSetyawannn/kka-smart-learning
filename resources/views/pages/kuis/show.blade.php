@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            {{-- BAGIAN KIRI: Daftar Langkah Soal yang Sudah Ada --}}
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>Daftar Langkah / Blok Logika</h6>
                            <span class="badge bg-gradient-primary">Total: {{ $kui->soal->count() }} Langkah</span>
                        </div>
                        <p class="text-sm mb-0">
                            Kuis: <strong>{{ $kui->judul_kuis }}</strong> ({{ $kui->kelas->nama_kelas }})
                        </p>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Urutan Benar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Isi
                                            Langkah / Teks</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Gambar (Opsional)</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                        </th>
                                </thead>
                                <tbody>
                                    @forelse ($kui->soal as $soal)
                                        <tr>
                                            {{-- Urutan --}}
                                            <td class="align-middle text-center">
                                                <h6 class="mb-0 text-sm">{{ $soal->urutan_benar }}</h6>
                                            </td>

                                            {{-- Teks Langkah --}}
                                            <td class="align-middle" style="white-space: normal !important;">
                                                <p class="text-xs font-weight-bold mb-0">{{ $soal->teks_langkah }}</p>
                                            </td>

                                            {{-- Gambar (Jika ada) --}}
                                            <td class="align-middle text-center">
                                                @if ($soal->gambar_langkah)
                                                    <a href="{{ asset('storage/' . $soal->gambar_langkah) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $soal->gambar_langkah) }}"
                                                            class="avatar avatar-sm rounded-3" alt="gambar">
                                                    </a>
                                                @else
                                                    <span class="text-secondary text-xs">-</span>
                                                @endif
                                            </td>

                                            {{-- Aksi Hapus --}}
                                            <td class="align-middle text-center">
                                                <form action="{{ route('soal.destroy', $soal->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                        onclick="return confirm('Hapus langkah ini?')">
                                                        <i class="far fa-trash-alt me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm py-4">
                                                Belum ada langkah soal yang dibuat. Silakan tambah di formulir sebelah
                                                kanan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('kuis.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Daftar
                            Kuis</a>
                    </div>
                </div>
            </div>

            {{-- BAGIAN KANAN: Form Tambah Langkah Baru --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Tambah Langkah Baru</h6>
                    </div>
                    <div class="card-body">
                        {{-- Form mengarah ke SoalKuisController --}}
                        <form action="{{ route('soal.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- ID Kuis (Hidden) --}}
                            <input type="hidden" name="kuis_id" value="{{ $kui->id }}">

                            {{-- 1. Urutan --}}
                            <div class="form-group">
                                <label for="urutan_benar" class="form-control-label">Urutan Langkah Ke-</label>
                                {{-- Otomatis mengisi urutan selanjutnya --}}
                                <input class="form-control" type="number" name="urutan_benar"
                                    value="{{ $kui->soal->count() + 1 }}" required>
                            </div>

                            {{-- 2. Teks Langkah --}}
                            <div class="form-group">
                                <label for="teks_langkah" class="form-control-label">Isi Teks Langkah</label>
                                <textarea class="form-control" name="teks_langkah" rows="3"
                                    placeholder="Contoh: Masukkan teh celup ke dalam gelas" required></textarea>
                            </div>

                            {{-- 3. Gambar (Opsional) --}}
                            <div class="form-group">
                                <label for="gambar_langkah" class="form-control-label">Gambar Pendukung (Opsional)</label>
                                <input class="form-control" type="file" name="gambar_langkah">
                                <small class="text-muted text-xs">Maks: 2MB (JPG, PNG)</small>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 mt-2 mb-0">
                                    <i class="fas fa-plus me-1"></i> Tambah Langkah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Informasi Singkat --}}
                <div class="card mt-4">
                    <div class="card-body p-3">
                        <div class="d-flex">
                            <div class="avatar avatar-md bg-gradient-info border-radius-md p-2">
                                <i class="fas fa-info text-white"></i>
                            </div>
                            <div class="ms-3 my-auto">
                                <h6>Instruksi Kuis</h6>
                                <p class="text-sm mb-0">{{ $kui->deskripsi ?? 'Tidak ada instruksi khusus.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
