<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('author')->default('Tim Redaksi ATN')->after('category');
            $table->string('tags')->nullable()->after('author');
            $table->unsignedInteger('reading_time')->default(1)->after('published_at');
            $table->unsignedBigInteger('views')->default(0)->after('reading_time');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['author', 'tags', 'reading_time', 'views']);
        });
    }
};
