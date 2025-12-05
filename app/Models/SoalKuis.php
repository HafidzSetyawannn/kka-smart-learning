<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKuis extends Model
{
    use HasFactory;
    protected $table = 'soal_kuis';
    protected $fillable = ['kuis_id', 'teks_langkah', 'urutan_benar', 'gambar_langkah'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'kuis_id');
    }
}
