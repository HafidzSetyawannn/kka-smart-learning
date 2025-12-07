<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'DifaSetyarini',
            'email' => 'difasetyarini@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
