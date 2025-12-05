<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soal_kuis', function (Blueprint $table) {
            $table->id();

            // Relasi ke Kuis (Soal ini milik kuis apa?)
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');

            // Isi dari blok yang akan di-drag
            $table->text('teks_langkah');

            // Kunci jawaban: Langkah ini seharusnya ada di urutan ke berapa?
            $table->integer('urutan_benar');

            // Opsional: Jika langkahnya bergambar
            $table->string('gambar_langkah')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_kuis');
    }
};
