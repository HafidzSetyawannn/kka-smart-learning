<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKuis extends Model
{
    use HasFactory;

    protected $table = 'nilai_kuis';
    protected $fillable = ['siswa_id', 'kuis_id', 'skor'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function kuis() {
        return $this->belongsTo(Kuis::class);
    }
}
