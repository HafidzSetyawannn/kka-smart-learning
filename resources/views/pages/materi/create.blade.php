@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Materi Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul" class="form-control-label">Judul Materi</label>
                                    <input class="form-control" type="text" name="judul" value="{{ old('judul') }}"
                                        placeholder="Contoh: Algoritma Dasar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas_id" class="form-control-label">Kelas</label>
                                    <select class="form-control" name="kelas_id">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id_kelas }}"
                                                {{ old('kelas_id') == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topik" class="form-control-label">Topik</label>
                                    <input class="form-control" type="text" name="topik" value="{{ old('topik') }}">
                                </div>
                            </div>

                            {{-- Dropdown Tipe --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe" class="form-control-label">Tipe Konten</label>
                                    <select class="form-control" name="tipe" id="tipe_konten" onchange="toggleInput()">
                                        <option value="gambar">Gambar</option>
                                        <option value="video">Video (Upload File)</option>
                                        <option value="pdf">File PDF</option>
                                        <option value="youtube">Video (Link YouTube)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark my-3">

                        {{-- 1. Input Upload File --}}
                        <div class="form-group" id="area_file">
                            <label class="form-control-label">Upload File Materi</label>
                            <input class="form-control" type="file" name="file_materi">
                            <small class="text-muted">Format: JPG, PNG, MP4, PDF.</small>
                        </div>

                        {{-- 2. Input Link YouTube (Default Hidden) --}}
                        <div class="form-group" id="area_youtube" style="display: none;">
                            <label class="form-control-label">Link YouTube</label>
                            <input class="form-control" type="url" name="link_youtube"
                                placeholder="Contoh: https://www.youtube.com/watch?v=xxxxx">
                            <small class="text-muted">Masukkan link lengkap video YouTube.</small>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary">Simpan Materi</button>
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
    </script>
@endsection
