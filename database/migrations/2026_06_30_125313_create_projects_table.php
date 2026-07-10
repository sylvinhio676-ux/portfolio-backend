<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('challenge')->nullable();
            $table->text('result')->nullable();
            $table->text('architecture')->nullable();
            $table->string('github_url', 500)->nullable();
            $table->string('demo_url', 500)->nullable();
            $table->string('video_url', 500)->nullable();
            $table->string('cover_image', 500)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
