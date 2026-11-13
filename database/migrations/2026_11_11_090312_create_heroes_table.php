<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('main_image');
            $table->string('side_image');
            $table->string('label');
            $table->string('description');
            $table->boolean('is_active')->default(true); // Untuk menonaktifkan slide tanpa menghapusnya
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
