@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- Kartu Profil & Ringkasan --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-xl rounded-circle bg-gradient-{{ $warna }}">
                                <i class="ni ni-single-02 text-white" style="font-size: 24px;"></i>
                            </div>
                        </div>
                        <div class="col ml-2">
                            <h5 class="mb-1 font-weight-bolder">{{ $siswa->nama_siswa }}</h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                NIS: {{ $siswa->nis }} | Kelas: {{ $siswa->kelas->nama_kelas }}
                            </p>
                            <p class="mb-0 text-sm text-secondary mt-2">
                                Status Pemahaman: <span
                                    class="badge bg-gradient-{{ $warna }}">{{ $predikat }}</span>
                            </p>
                        </div>
                        <div class="col-auto text-end">
                            <h2 class="text-{{ $warna }} text-center font-weight-bolder mb-0">{{ $rataRata }}</h2>
                            <span class="text-xs text-secondary">Rata-rata Nilai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Detail Nilai Kuis --}}
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Riwayat Pengerjaan Kuis</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Judul Kuis</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Topik</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nilai</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilDetail as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <h6 class="mb-0 text-sm">{{ $item['kuis'] }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item['topik'] ?? '-' }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item['tanggal'] }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6 class="text-sm font-weight-bold mb-0">{{ $item['skor'] }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($item['skor'] !== '-')
                                                    <span
                                                        class="badge badge-sm bg-gradient-{{ $item['skor'] >= 75 ? 'success' : 'danger' }}">
                                                        {{ $item['status'] }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Belum</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kartu Rekomendasi AI --}}
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Analisis & Rekomendasi</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="alert alert-light border-0 text-dark" role="alert">
                            <h4 class="alert-heading font-weight-bolder"><i
                                    class="ni ni-bulb-61 text-warning me-2"></i>Insight</h4>
                            <p class="text-sm mb-0">
                                {{ $rekomendasi }}
                            </p>
                        </div>

                        <hr class="horizontal dark">
                        <p class="text-xs text-secondary mb-0">
                            Analisis ini dibuat berdasarkan rata-rata nilai dan topik kuis yang dikerjakan siswa.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('evaluasi.show', $siswa->kelas_id) }}"
                            class="btn btn-outline-secondary w-100">Kembali ke Daftar Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
