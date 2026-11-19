<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('facebook_url')->nullable()->after('workflow_image');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('instagram_url');
            $table->string('youtube_url')->nullable()->after('linkedin_url');
            $table->string('copyright_text')->nullable()->after('youtube_url');
            $table->string('career_url')->nullable()->after('copyright_text');
            $table->string('maps_url')->nullable()->after('career_url');
            $table->text('maps_embed')->nullable()->after('maps_url');
            $table->string('maps_image')->nullable()->after('maps_embed');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'facebook_url',
                'instagram_url',
                'linkedin_url',
                'youtube_url',
                'copyright_text',
                'career_url',
                'maps_url',
                'maps_embed',
                'maps_image',
            ]);
        });
    }
};
