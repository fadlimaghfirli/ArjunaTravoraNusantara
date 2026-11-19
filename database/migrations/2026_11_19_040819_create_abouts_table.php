<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('description'); // Paragraf profil (Enter untuk paragraf baru)
            $table->text('vision');      // Teks Visi
            $table->text('missions');    // Poin Misi (Satu per baris, format "Judul: Penjelasan")
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
