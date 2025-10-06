@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Data Siswa: {{ $siswa->nama_siswa }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="kelas_id" value="{{ $siswa->kelas_id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_siswa" class="form-control-label">Nama Lengkap Siswa</label>
                                    <input class="form-control @error('nama_siswa') is-invalid @enderror" type="text"
                                        name="nama_siswa" id="nama_siswa"
                                        value="{{ old('nama_siswa', $siswa->nama_siswa) }}">
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nis" class="form-control-label">Nomor Induk Siswa (NIS)</label>
                                    <input class="form-control @error('nis') is-invalid @enderror" type="text"
                                        name="nis" id="nis" value="{{ old('nis', $siswa->nis) }}">
                                    @error('nis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas_info" class="form-control-label">Kelas</label>
                                    <input class="form-control" type="text" id="kelas_info"
                                        value="{{ $siswa->kelas->nama_kelas ?? 'Tidak ada kelas' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_absen" class="form-control-label">Nomor Absen</label>
                                    <input class="form-control @error('no_absen') is-invalid @enderror" type="number"
                                        name="no_absen" id="no_absen" value="{{ old('no_absen', $siswa->no_absen) }}">
                                    @error('no_absen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary">Update Data</button>
                            <a href="{{ route('kelas.siswa.index', $siswa->kelas_id) }}"
                                class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
