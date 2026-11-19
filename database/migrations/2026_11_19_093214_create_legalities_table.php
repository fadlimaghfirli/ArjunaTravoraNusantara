<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legalities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('document_number')->nullable();
            $table->string('description', 255)->nullable();
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legalities');
    }
};
