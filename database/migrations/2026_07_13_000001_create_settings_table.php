<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Général
            $table->string('site_name')->nullable();
            $table->string('logo_url', 500)->nullable();
            $table->string('favicon_url', 500)->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_location')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('availability_message')->nullable();
            $table->boolean('maintenance_mode')->default(false);

            // Apparence
            $table->string('theme_default')->default('dark');
            $table->string('primary_color')->nullable();
            $table->string('font_heading')->nullable();
            $table->string('font_body')->nullable();
            $table->string('border_radius')->nullable();

            // SEO / Analytics
            $table->string('analytics_id')->nullable();
            $table->string('search_console_verification')->nullable();
            $table->string('default_og_image', 500)->nullable();
            $table->string('default_robots')->default('index,follow');
            $table->boolean('sitemap_enabled')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
