<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable()->change();
            $table->time('jam_akhir')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable(false)->change();
            $table->time('jam_akhir')->nullable(false)->change();
        });
    }
};
