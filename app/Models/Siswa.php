<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// [PENTING] Ganti 'Model' biasa menjadi 'Authenticatable'
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Authenticatable // <-- Ubah ini
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama_siswa',
        'nis',
        'no_absen',
        'kelas_id',
        'password', // <-- Jangan lupa tambahkan ini
        'avatar',
    ];

    // Sembunyikan password saat data diambil
    protected $hidden = [
        'password',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function nilai_kuis()
    {
        return $this->hasMany(NilaiKuis::class);
    }
}
