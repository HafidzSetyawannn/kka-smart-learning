@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Tabel Data Kelas</h6>
                        <a href="{{ route('kelas.create') }}" class="btn bg-gradient-primary btn-sm">
                            </i> Tambah Data
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

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
                                            Nama Kelas</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Guru Wali Kelas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataKelas as $kelas)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $loop->iteration + $dataKelas->firstItem() - 1 }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $kelas->nama_kelas }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $kelas->nama_guru }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('kelas.edit', $kelas->id_kelas) }}"
                                                    class="btn btn-link text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                                <a href="{{ route('kelas.siswa.index', $kelas->id_kelas) }}"
                                                    class="btn btn-link text-info font-weight-bold text-xs">
                                                    Detail
                                                </a>
                                                <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger font-weight-bold text-xs"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm">
                                                Tidak ada data untuk ditampilkan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $dataKelas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
