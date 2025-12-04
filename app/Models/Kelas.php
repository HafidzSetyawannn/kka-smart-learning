<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'nama_kelas',
        'nama_guru',
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id_kelas');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kelas_id', 'id_kelas');
    }
}
