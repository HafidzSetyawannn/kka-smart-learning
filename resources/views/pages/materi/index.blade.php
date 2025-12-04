@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Tabel Data Materi</h6>
                        <a href="{{ route('materi.create') }}" class="btn bg-gradient-primary btn-sm">
                            <i class="fas fa-plus me-2"></i> Tambah Materi
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
                                            Judul Materi</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Topik</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tipe</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kelas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($materis as $materi)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $loop->iteration + $materis->firstItem() - 1 }}
                                                    </h6>
                                                </div>
                                            </td>

                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $materi->judul }}</p>
                                            </td>

                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $materi->topik ?? '-' }}</p>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold text-uppercase">
                                                    {{ $materi->tipe }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $materi->kelas->nama_kelas ?? 'Umum' }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <a href="{{ route('materi.edit', $materi->id) }}"
                                                    class="btn btn-link text-secondary font-weight-bold text-xs">
                                                    Edit
                                                </a>

                                                <a href="{{ route('materi.show', $materi->id) }}"
                                                    class="btn btn-link text-info font-weight-bold text-xs">
                                                    Detail
                                                </a>

                                                <form action="{{ route('materi.destroy', $materi->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger font-weight-bold text-xs"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-sm py-4">
                                                Belum ada data materi untuk ditampilkan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $materis->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
