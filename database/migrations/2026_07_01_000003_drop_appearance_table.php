<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Les couleurs du site sont désormais gérées uniquement dans le frontend
 * (app/globals.css). La table appearance et ses endpoints ont été retirés.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('appearance');
    }

    public function down(): void
    {
        Schema::create('appearance', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color', 20)->default('#00E5C3');
            $table->string('background', 20)->default('#09090B');
            $table->string('surface', 20)->default('#111827');
            $table->string('card', 20)->default('#18181B');
            $table->string('border_color', 20)->default('#27272A');
            $table->string('font_heading', 100)->default('Space Grotesk');
            $table->string('font_body', 100)->default('Inter');
            $table->string('border_radius', 20)->default('8px');
            $table->boolean('animations_on')->default(true);
            $table->timestamps();
        });
    }
};
