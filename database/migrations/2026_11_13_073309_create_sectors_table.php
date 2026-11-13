<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Contoh: HealthCare
            $table->string('title'); // Contoh: Sistem Manajemen Rumah Sakit...
            $table->text('description'); // Paragraf penjelasan
            $table->text('features'); // Fitur/poin (dipisah dengan Enter/baris baru)
            $table->string('image'); // Gambar background
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
