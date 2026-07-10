<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('tagline', 500)->nullable();
            $table->text('bio');
            $table->string('photo_url', 500)->nullable();
            $table->string('cv_url', 500)->nullable();
            $table->unsignedInteger('stat_projects')->default(0);
            $table->unsignedInteger('stat_years')->default(0);
            $table->unsignedInteger('stat_techs')->default(0);
            $table->string('hero_cta1_label', 100)->nullable();
            $table->string('hero_cta1_url', 500)->nullable();
            $table->string('hero_cta2_label', 100)->nullable();
            $table->string('hero_cta2_url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};
