<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certification_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certification_id')
                ->constrained('certifications')
                ->cascadeOnDelete();
            // Type de document : 'certificate', 'qr', 'autre'…
            $table->string('type');
            $table->string('url', 500);
            $table->string('public_id', 500)->nullable();
            $table->string('name')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certification_documents');
    }
};
