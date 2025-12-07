<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Kelas;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::where('nama_kelas', 'Kelas 5A')->first();

        if ($kelas) {
            // Contoh Materi Video YouTube
            Materi::create([
                'kelas_id'     => $kelas->id_kelas,
                'judul'        => 'Pengenalan Algoritma Dasar',
                'topik'        => 'Algoritma',
                'tipe'         => 'youtube',
                'link_youtube' => 'https://www.youtube.com/watch?v=kM9ASKDnPKs', // Video sampel
                'file_path'    => null,
            ]);

            // Contoh Materi PDF (Dummy Path)
            Materi::create([
                'kelas_id'  => $kelas->id_kelas,
                'judul'     => 'Modul Belajar Flowchart',
                'topik'     => 'Algoritma',
                'tipe'      => 'pdf',
                'file_path' => 'materi/dummy.pdf', // Pastikan file ini ada di storage jika ingin dites
            ]);
        }
    }
}
