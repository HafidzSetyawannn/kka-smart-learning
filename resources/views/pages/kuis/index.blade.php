@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    {{-- Header: Judul & Tombol Tambah --}}
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Tabel Data Kuis</h6>
                        <a href="{{ route('kuis.create') }}" class="btn bg-gradient-primary btn-sm">
                            <i class="fas fa-plus me-2"></i> Tambah Kuis Baru
                        </a>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">

                        {{-- Pesan Notifikasi --}}
                        @if (session('success'))
                            <div class="alert alert-{{ session('alert-type', 'success') }} text-white mx-4" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Judul Kuis</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Topik</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kelas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah Soal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kuis as $item)
                                        <tr>
                                            {{-- No --}}
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration + $kuis->firstItem() - 1 }}
                                                    </h6>
                                                </div>
                                            </td>

                                            {{-- Judul Kuis --}}
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->judul_kuis }}</p>
                                            </td>

                                            {{-- Topik --}}
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->topik ?? '-' }}</p>
                                            </td>

                                            {{-- Kelas --}}
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $item->kelas->nama_kelas ?? 'Umum' }}
                                                </span>
                                            </td>

                                            {{-- Jumlah Soal (Hitung dari relasi) --}}
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $item->soal->count() }} Soal
                                                </span>
                                            </td>

                                            {{-- Aksi --}}
                                            <td class="align-middle text-center">
                                                <form action="{{ route('kuis.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">

                                                    {{-- Tombol Kelola Soal (PENTING) --}}
                                                    <a href="{{ route('kuis.show', $item->id) }}"
                                                        class="btn btn-link text-primary font-weight-bold text-xs">
                                                        <i class="fa fa-list-ol me-1"></i> Kelola Soal
                                                    </a>

                                                    {{-- Edit --}}
                                                    <a href="{{ route('kuis.edit', $item->id) }}"
                                                        class="btn btn-link text-secondary font-weight-bold text-xs">
                                                        Edit
                                                    </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    {{-- Hapus --}}
                                                    <button type="submit"
                                                        class="btn btn-link text-danger font-weight-bold text-xs"
                                                        onclick="return confirm('Yakin hapus kuis ini? Semua soal di dalamnya juga akan terhapus.');"
                                                        title="Hapus">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-sm py-4">
                                                Belum ada kuis yang dibuat.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginasi --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $kuis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
