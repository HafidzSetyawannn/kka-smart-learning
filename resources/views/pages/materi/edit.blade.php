@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Materi: {{ $materi->judul }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul" class="form-control-label">Judul Materi</label>
                                    <input class="form-control @error('judul') is-invalid @enderror" type="text"
                                        name="judul" value="{{ old('judul', $materi->judul) }}"
                                        placeholder="Contoh: Pengenalan Algoritma">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas_id" class="form-control-label">Kelas</label>
                                    <select class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id_kelas }}"
                                                {{ old('kelas_id', $materi->kelas_id) == $k->id_kelas ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topik" class="form-control-label">Topik / Bab</label>
                                    <input class="form-control @error('topik') is-invalid @enderror" type="text"
                                        name="topik" value="{{ old('topik', $materi->topik) }}"
                                        placeholder="Contoh: Berpikir Komputasional">
                                    @error('topik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe" class="form-control-label">Tipe Konten</label>
                                    <select class="form-control @error('tipe') is-invalid @enderror" name="tipe">
                                        <option value="">Pilih Tipe</option>
                                        <option value="gambar"
                                            {{ old('tipe', $materi->tipe) == 'gambar' ? 'selected' : '' }}>Gambar</option>
                                        <option value="video"
                                            {{ old('tipe', $materi->tipe) == 'video' ? 'selected' : '' }}>Video</option>
                                        <option value="pdf" {{ old('tipe', $materi->tipe) == 'pdf' ? 'selected' : '' }}>
                                            File PDF</option>
                                    </select>
                                    @error('tipe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="horizontal dark my-3">

                        <div class="form-group">
                            <label for="file_materi" class="form-control-label">File Materi</label>

                            <div class="mb-2">
                                <span class="badge bg-gradient-secondary">File Saat Ini:</span>
                                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                    class="text-sm text-primary ms-1">
                                    <i class="fa fa-external-link-alt me-1"></i> Lihat File
                                </a>
                            </div>

                            <input class="form-control @error('file_materi') is-invalid @enderror" type="file"
                                name="file_materi" id="file_materi">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file.</small>
                            @error('file_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
@endsection
