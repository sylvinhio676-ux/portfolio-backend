<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->string('location')->nullable()->after('title');
            $table->string('email')->nullable()->after('location');
            $table->string('availability')->nullable()->after('email');
            $table->text('philosophy')->nullable()->after('bio');
            $table->unsignedInteger('stat_clients')->default(0)->after('stat_techs');
        });
    }

    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'email',
                'availability',
                'philosophy',
                'stat_clients',
            ]);
        });
    }
};
