<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul project
            $table->string('category'); // Misal: Web System, Sidoarjo
            $table->string('year'); // Misal: 2025
            $table->string('type')->default('Project'); // Teks besar di background (Project / Portfolio)
            $table->string('image'); // Path gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
