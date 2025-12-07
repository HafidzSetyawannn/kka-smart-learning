<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kelas' => 'Kelas 5A', 'nama_guru' => 'Difa Setyarini, S.Pd.'],
            ['nama_kelas' => 'Kelas 5B', 'nama_guru' => 'Joko Anwar, S.Pd.'],
            ['nama_kelas' => 'Kelas 6A', 'nama_guru' => 'Dewi Persik, S.Pd.'],
        ];

        foreach ($data as $item) {
            Kelas::create($item);
        }
    }
}
