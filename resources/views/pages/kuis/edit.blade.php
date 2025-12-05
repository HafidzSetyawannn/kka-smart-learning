@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Informasi Kuis</h6>
                    </div>
                    <div class="card-body">
                        {{-- Form Edit mengarah ke method UPDATE --}}
                        <form action="{{ route('kuis.update', $kui->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- 1. Judul Kuis --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul_kuis" class="form-control-label">Judul Kuis <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control @error('judul_kuis') is-invalid @enderror" type="text"
                                            name="judul_kuis" value="{{ old('judul_kuis', $kui->judul_kuis) }}" required>
                                        @error('judul_kuis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 2. Topik --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="topik" class="form-control-label">Topik</label>
                                        <input class="form-control @error('topik') is-invalid @enderror" type="text"
                                            name="topik" value="{{ old('topik', $kui->topik) }}">
                                        @error('topik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- 3. Pilih Kelas --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_id" class="form-control-label">Kelas <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id"
                                            required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id_kelas }}"
                                                    {{ old('kelas_id', $kui->kelas_id) == $k->id_kelas ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 4. Deskripsi --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi" class="form-control-label">Instruksi Pengerjaan</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="1">{{ old('deskripsi', $kui->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn bg-gradient-primary">Simpan Perubahan</button>
                                <a href="{{ route('kuis.index') }}" class="btn btn-link">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
