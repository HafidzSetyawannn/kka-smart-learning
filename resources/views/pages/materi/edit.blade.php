@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Edit Materi: {{ $materi->judul }}</h6>
            </div>
            <div class="card-body">
                {{-- Form Update --}}
                <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- 1. Judul Materi --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul" class="form-control-label">Judul Materi</label>
                                <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" value="{{ old('judul', $materi->judul) }}" placeholder="Contoh: Pengenalan Algoritma">
                                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- 2. Pilih Kelas --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas_id" class="form-control-label">Kelas</label>
                                <select class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id_kelas }}" {{ old('kelas_id', $materi->kelas_id) == $k->id_kelas ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- 3. Topik --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="topik" class="form-control-label">Topik / Bab</label>
                                <input class="form-control @error('topik') is-invalid @enderror" type="text" name="topik" value="{{ old('topik', $materi->topik) }}" placeholder="Contoh: Berpikir Komputasional">
                                @error('topik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- 4. Tipe Konten --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipe" class="form-control-label">Tipe Konten</label>
                                <select class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe_konten" onchange="toggleInput()">
                                    <option value="gambar" {{ old('tipe', $materi->tipe) == 'gambar' ? 'selected' : '' }}>Gambar</option>
                                    <option value="video" {{ old('tipe', $materi->tipe) == 'video' ? 'selected' : '' }}>Video (Upload File)</option>
                                    <option value="pdf" {{ old('tipe', $materi->tipe) == 'pdf' ? 'selected' : '' }}>File PDF</option>
                                    <option value="youtube" {{ old('tipe', $materi->tipe) == 'youtube' ? 'selected' : '' }}>Video (Link YouTube)</option>
                                </select>
                                @error('tipe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark my-3">

                    {{-- AREA DINAMIS --}}

                    {{-- A. Input Upload File (Untuk Gambar/Video/PDF) --}}
                    <div class="form-group" id="area_file">
                        <label for="file_materi" class="form-control-label">File Materi</label>

                        {{-- Info File Lama (Jika ada & Tipe bukan Youtube) --}}
                        @if($materi->file_path && $materi->tipe != 'youtube')
                            <div class="mb-2">
                                <span class="badge bg-gradient-secondary">File Saat Ini:</span>
                                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="text-sm text-primary ms-1">
                                    <i class="fa fa-external-link-alt me-1"></i> Lihat File
                                </a>
                            </div>
                        @endif

                        <input class="form-control @error('file_materi') is-invalid @enderror" type="file" name="file_materi">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file.</small>
                        @error('file_materi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- B. Input Link YouTube --}}
                    <div class="form-group" id="area_youtube" style="display: none;">
                        <label class="form-control-label">Link YouTube</label>
                        <input class="form-control @error('link_youtube') is-invalid @enderror" type="url" name="link_youtube"
                               value="{{ old('link_youtube', $materi->link_youtube) }}"
                               placeholder="Contoh: https://www.youtube.com/watch?v=xxxxx">
                        <small class="text-muted">Masukkan link lengkap video YouTube.</small>
                        @error('link_youtube') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn bg-gradient-primary">Update Materi</button>
                        <a href="{{ route('materi.index') }}" class="btn btn-link">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleInput() {
        var tipe = document.getElementById("tipe_konten").value;
        var areaFile = document.getElementById("area_file");
        var areaYoutube = document.getElementById("area_youtube");

        if (tipe === 'youtube') {
            areaFile.style.display = 'none';
            areaYoutube.style.display = 'block';
        } else {
            areaFile.style.display = 'block';
            areaYoutube.style.display = 'none';
        }
    }

    // Jalankan saat halaman dimuat agar input yang benar muncul sesuai data yang ada
    document.addEventListener("DOMContentLoaded", function() {
        toggleInput();
    });
</script>
@endsection
