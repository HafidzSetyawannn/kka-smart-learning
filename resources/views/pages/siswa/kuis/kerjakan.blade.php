@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    {{-- Header Kuis --}}
                    <div class="card-header bg-white pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1 font-weight-bolder text-dark">{{ $kuis->judul_kuis }}</h5>
                                <span class="badge bg-gradient-secondary">{{ $kuis->topik }}</span>
                            </div>
                            <span class="badge bg-gradient-info px-3 py-2">Susun Langkah Berikut</span>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Instruksi --}}
                        <div class="alert alert-secondary text-white border-0 shadow-sm mb-4" role="alert">
                            <i class="ni ni-bulb-61 me-2"></i>
                            <strong>Instruksi:</strong>
                            {{ $kuis->deskripsi ?? 'Seret dan lepaskan (Drag & Drop) blok di bawah ini untuk mengurutkannya menjadi langkah yang benar.' }}
                        </div>

                        {{-- AREA DRAG & DROP --}}
                        {{-- [PERBAIKAN] Action diarahkan ke route submit --}}
                        <form action="{{ route('siswa.kuis.submit', $kuis->id) }}" method="POST" id="formKuis">
                            @csrf

                            {{-- Container untuk item yang bisa digeser --}}
                            <div id="sortable-list" class="list-group mb-4 gap-2">
                                @foreach ($soalAcak as $soal)
                                    <div class="list-group-item border rounded p-3 cursor-move shadow-sm draggable-item d-flex align-items-center"
                                        data-id="{{ $soal->id }}"
                                        style="cursor: grab; background: #fff; transition: all 0.2s;">

                                        {{-- Ikon Grip (Pegangan) --}}
                                        <div class="me-3 text-secondary opacity-5">
                                            <i class="fas fa-grip-vertical fa-lg"></i>
                                        </div>

                                        {{-- Konten Soal --}}
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark font-weight-bold">{{ $soal->teks_langkah }}</h6>
                                            @if ($soal->gambar_langkah)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $soal->gambar_langkah) }}"
                                                        class="img-fluid rounded border"
                                                        style="max-height: 150px; object-fit: cover;" alt="Gambar Langkah">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Input tersembunyi untuk menyimpan urutan jawaban siswa --}}
                            <input type="hidden" name="jawaban_siswa" id="jawaban_siswa">

                            <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                                <a href="{{ route('siswa.kuis.index') }}"
                                    class="btn btn-outline-secondary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>
                                <button type="button" onclick="submitJawaban()"
                                    class="btn bg-gradient-primary btn-lg px-5">
                                    <i class="fas fa-check-circle me-2"></i> Kirim Jawaban
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Load Library SortableJS dari CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <script>
        // 1. Aktifkan fitur Drag & Drop pada list
        var el = document.getElementById('sortable-list');
        var sortable = Sortable.create(el, {
            animation: 150, // Animasi halus saat digeser
            ghostClass: 'sortable-ghost', // Class saat item sedang di-drag
            chosenClass: 'sortable-chosen', // Class saat item dipilih
            dragClass: 'sortable-drag', // Class item yang sedang melayang
            handle: '.list-group-item', // Seluruh kotak bisa di-klik untuk drag
        });

        // 2. Fungsi saat tombol Kirim diklik
        function submitJawaban() {
            // Ambil urutan ID soal yang baru (setelah diacak siswa)
            var urutan = sortable.toArray();

            // Masukkan ke input hidden
            document.getElementById('jawaban_siswa').value = JSON.stringify(urutan);

            // [PERBAIKAN] Submit form yang sebenarnya
            document.getElementById('formKuis').submit();
        }
    </script>

    <style>
        /* Style tambahan agar interaksi lebih enak */
        .draggable-item:hover {
            background-color: #f8f9fa !important;
            border-color: #5e72e4 !important;
            transform: translateY(-2px);
        }

        /* Efek saat item diangkat/digeser */
        .sortable-ghost {
            opacity: 0.4;
            background-color: #e9ecef !important;
            border: 2px dashed #ced4da !important;
        }

        .sortable-chosen {
            background-color: #fff !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endsection
