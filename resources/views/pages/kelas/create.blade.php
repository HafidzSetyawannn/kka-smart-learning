@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Data Kelas Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_kelas" class="form-control-label">Nama Kelas</label>
                                    <input class="form-control @error('nama_kelas') is-invalid @enderror" type="text"
                                        name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}"
                                        placeholder="Contoh: Kelas 1A">
                                    @error('nama_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_guru" class="form-control-label">Nama Guru / Wali Kelas</label>
                                    <input class="form-control @error('nama_guru') is-invalid @enderror" type="text"
                                        name="nama_guru" id="nama_guru" value="{{ old('nama_guru') }}"
                                        placeholder="Contoh: Budi Santoso, S.Pd.">
                                    @error('nama_guru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary">Simpan Data</button>
                            <a href="{{ route('kelas.index') }}" class="btn btn-link">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
