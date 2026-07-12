<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('school_logo', 500)->nullable();
            $table->string('diploma');
            $table->string('field_of_study');
            $table->string('academic_level');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('website', 500)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->string('grade')->nullable();
            $table->string('mention')->nullable();
            $table->text('achievements')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->boolean('featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
