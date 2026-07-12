<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('provider');
            $table->string('provider_logo', 500)->nullable();
            $table->string('category')->nullable();
            $table->string('credential_id')->nullable();
            $table->date('issue_date');
            $table->date('expiration_date')->nullable();
            $table->boolean('never_expire')->default(false);
            $table->string('verification_url', 500)->nullable();
            $table->string('certificate_url', 500)->nullable();
            $table->string('badge', 500)->nullable();
            $table->text('description')->nullable();
            $table->integer('duration_hours')->nullable();
            $table->string('score')->nullable();
            $table->string('language')->nullable();
            $table->string('level')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
