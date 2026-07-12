<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')
                ->constrained('education')
                ->cascadeOnDelete();
            // Type de document : memoire | rapport | diplome | autre
            $table->string('type', 50);
            $table->string('url', 500);
            $table->string('public_id', 500)->nullable();
            $table->string('name')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_documents');
    }
};
