<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $fillable = [
        'kelas_id',
        'judul',
        'topik',
        'tipe',
        'file_path',
        'link_youtube',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function getYoutubeEmbedAttribute()
    {
        if ($this->tipe !== 'youtube' || !$this->link_youtube) {
            return null;
        }

        $url = $this->link_youtube;
        $pattern = '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
            youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
            (?:           # Group path alternatives
                /embed/     # Either /embed/
            | /v/         # or /v/
            | /watch\?v=  # or /watch\?v=
            )
            )
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x';

        $result = preg_match($pattern, $url, $matches);

        if ($result) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
