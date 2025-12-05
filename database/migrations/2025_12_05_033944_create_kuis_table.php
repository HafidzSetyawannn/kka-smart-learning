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
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            // Relasi ke Kelas (Kuis ini untuk kelas mana?)
            $table->foreignId('kelas_id')->constrained('kelas', 'id_kelas')->onDelete('cascade');

            $table->string('judul_kuis');
            $table->string('topik')->nullable();
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
