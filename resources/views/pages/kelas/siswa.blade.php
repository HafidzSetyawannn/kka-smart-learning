@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Tabel Data Siswa: Kelas {{ $kelas->nama_kelas }}</h6>
                    <a href="{{ route('siswas.create', ['kelas_id' => $kelas->id_kelas]) }}"
                        class="btn bg-gradient-primary btn-sm">
                        <i class="fas fa-plus me-2"></i> Tambah Siswa
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Siswa</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No. Absen</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswas as $siswa)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <h6 class="mb-0 text-sm">{{ $loop->iteration + $siswas->firstItem() - 1 }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $siswa->nis ?? '-' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $siswa->nama_siswa }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $siswa->no_absen }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST">
                                                <a href="{{ route('siswas.edit', $siswa->id) }}"
                                                    class="btn btn-link text-secondary font-weight-bold text-xs">
                                                    Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger font-weight-bold text-xs"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-sm py-4">
                                            Belum ada data siswa di kelas ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="{{ route('kelas.index') }}" class="btn btn-outline-primary btn-sm mb-0">
                        Kembali ke Daftar Kelas
                    </a>
                    {{-- Paginasi --}}
                    <div class="d-inline-block">
                        {{ $siswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
