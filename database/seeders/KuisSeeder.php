<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kuis;
use App\Models\SoalKuis;
use App\Models\Kelas;

class KuisSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::where('nama_kelas', 'Kelas 5A')->first();

        if ($kelas) {
            // 1. Buat Kuis
            $kuis = Kuis::create([
                'kelas_id'   => $kelas->id_kelas,
                'judul_kuis' => 'Latihan Logika: Membuat Kopi',
                'topik'      => 'Algoritma Sekuensial',
                'deskripsi'  => 'Urutkan langkah-langkah membuat kopi berikut ini dengan benar dari awal sampai akhir.',
            ]);

            // 2. Buat Soal (Langkah-langkah)
            $langkah = [
                ['urutan' => 1, 'teks' => 'Siapkan cangkir, sendok, kopi, dan gula'],
                ['urutan' => 2, 'teks' => 'Masukkan kopi bubuk dan gula ke dalam cangkir'],
                ['urutan' => 3, 'teks' => 'Tuangkan air panas secukupnya'],
                ['urutan' => 4, 'teks' => 'Aduk hingga gula larut dan tercampur rata'],
                ['urutan' => 5, 'teks' => 'Kopi siap disajikan'],
            ];

            foreach ($langkah as $item) {
                SoalKuis::create([
                    'kuis_id'      => $kuis->id,
                    'teks_langkah' => $item['teks'],
                    'urutan_benar' => $item['urutan'],
                ]);
            }
        }
    }
}
