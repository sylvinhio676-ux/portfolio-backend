<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('skill_categories')
                ->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('logo_url', 500)->nullable();
            $table->unsignedTinyInteger('level')->default(50); // 0-100
            $table->string('color', 20)->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
