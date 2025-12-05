<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kuis extends Model
{
    use HasFactory;
    protected $table = 'kuis';
    protected $fillable = ['kelas_id', 'judul_kuis', 'topik', 'deskripsi'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function soal()
    {
        // Satu kuis punya banyak langkah soal, diurutkan berdasarkan urutan yang benar
        return $this->hasMany(SoalKuis::class, 'kuis_id')->orderBy('urutan_benar');
    }

    public function nilai_siswa()
    {
        return $this->hasOne(NilaiKuis::class, 'kuis_id')
                    ->where('siswa_id', auth()->guard('siswa')->id())
                    ->latest(); // Ambil nilai terakhir jika ada banyak percobaan
    }
}
