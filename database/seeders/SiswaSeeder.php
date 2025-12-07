<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Pakai nama Indonesia
        $kelasAll = Kelas::all();

        foreach ($kelasAll as $kelas) {
            for ($i = 1; $i <= 5; $i++) {
                $nis = $faker->unique()->numerify('2024####'); // Contoh NIS: 20244829

                Siswa::create([
                    'kelas_id'   => $kelas->id_kelas,
                    'nama_siswa' => $faker->name,
                    'nis'        => $nis,
                    'no_absen'   => $i,
                    'password'   => Hash::make($nis), // Password = NIS
                    'avatar'     => null,
                ]);
            }
        }
    }
}
