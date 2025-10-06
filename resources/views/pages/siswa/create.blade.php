@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>
                        @if ($selectedKelas)
                            Tambah Siswa Baru untuk Kelas: {{ $selectedKelas->nama_kelas }}
                        @else
                            Tambah Data Siswa Baru
                        @endif
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_siswa" class="form-control-label">Nama Lengkap Siswa</label>
                                    <input class="form-control @error('nama_siswa') is-invalid @enderror" type="text"
                                        name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa') }}"
                                        placeholder="Masukkan nama siswa">
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nis" class="form-control-label">Nomor Induk Siswa (NIS)</label>
                                    <input class="form-control @error('nis') is-invalid @enderror" type="text"
                                        name="nis" id="nis" value="{{ old('nis') }}"
                                        placeholder="Masukkan NIS">
                                    @error('nis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Kelas</label>
                                    <input class="form-control" type="text" value="{{ $selectedKelas->nama_kelas }}"
                                        readonly>
                                    <input type="hidden" name="kelas_id" value="{{ $selectedKelas->id_kelas }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_absen" class="form-control-label">Nomor Absen</label>
                                    <input class="form-control @error('no_absen') is-invalid @enderror" type="number"
                                        name="no_absen" id="no_absen" value="{{ old('no_absen') }}"
                                        placeholder="Masukkan nomor absen">
                                    @error('no_absen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary">Simpan Data</button>
                            <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
