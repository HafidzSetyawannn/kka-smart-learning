@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">

            {{-- BAGIAN KIRI: KARTU PROFIL --}}
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="{{ asset('assets/img/bg-profile.jpg') }}" alt="Image placeholder" class="card-img-top">

                    {{-- AVATAR CENTER --}}
                    <div class="d-flex justify-content-center mt-n5">
                        <a href="javascript:;">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                     class="rounded-circle border border-2 border-white"
                                     style="width:150px; height:150px; object-fit:cover;">
                            @else
                                {{-- Avatar Default --}}
                                <div class="rounded-circle border border-2 border-white bg-gradient-primary
                                            d-flex align-items-center justify-content-center"
                                    style="width:150px; height:150px;">
                                    <i class="ni ni-single-02 text-white fa-3x"></i>
                                </div>
                            @endif
                        </a>
                    </div>

                    {{-- DATA USER --}}
                    <div class="card-body pt-0">
                        <div class="text-center mt-3">
                            <h5>{{ $role == 'guru' ? $user->name : $user->nama_siswa }}</h5>

                            <div class="h6 font-weight-300">
                                <i class="ni location_pin mr-2"></i>
                                {{ $role == 'guru' ? 'Guru / Admin' : 'Siswa Kelas ' . ($user->kelas->nama_kelas ?? '-') }}
                            </div>

                            <div class="h6 mt-3">
                                <i class="ni business_briefcase-24 mr-2"></i>
                                {{ $role == 'guru' ? $user->email : 'NIS: ' . $user->nis }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BAGIAN KANAN: FORM EDIT --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profil</p>
                        </div>
                    </div>

                    <div class="card-body">

                        {{-- Alert Sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success text-white" role="alert">
                                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        {{-- Menentukan Route berdasarkan Role --}}
                        <form action="{{ $role == 'guru' ? route('profile.update') : route('siswa.profile.update') }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <p class="text-uppercase text-sm">Informasi User</p>

                            <div class="row">
                                {{-- Nama Lengkap --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nama Lengkap</label>
                                        <input class="form-control @error('name') is-invalid @enderror @error('nama_siswa') is-invalid @enderror"
                                               type="text"
                                               name="{{ $role == 'guru' ? 'name' : 'nama_siswa' }}"
                                               value="{{ old('name', $role == 'guru' ? $user->name : $user->nama_siswa) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('nama_siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email / NIS --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ $role == 'guru' ? 'Email' : 'NIS' }}</label>
                                        <input class="form-control" type="text"
                                               value="{{ $role == 'guru' ? $user->email : $user->nis }}" readonly>
                                        <small class="text-muted text-xs">
                                            Untuk mengubah {{ $role == 'guru' ? 'Email' : 'NIS' }}, hubungi administrator.
                                        </small>
                                    </div>
                                </div>

                                {{-- Upload Foto --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Ganti Foto Profil</label>
                                        <input type="file" name="avatar" class="form-control">
                                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB.</small>
                                        @error('avatar')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">

                            {{-- Ganti Password --}}
                            <p class="text-uppercase text-sm">Ganti Password</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Password Baru</label>
                                        <input class="form-control @error('password') is-invalid @enderror"
                                               type="password" name="password"
                                               placeholder="Kosongkan jika tidak ingin mengganti">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Konfirmasi Password Baru</label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                               placeholder="Ulangi password baru">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
