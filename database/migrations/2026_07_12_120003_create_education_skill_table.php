<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_skill', function (Blueprint $table) {
            $table->foreignId('education_id')
                ->constrained('education')
                ->cascadeOnDelete();
            $table->foreignId('skill_id')
                ->constrained('skills')
                ->cascadeOnDelete();
            $table->primary(['education_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_skill');
    }
};
