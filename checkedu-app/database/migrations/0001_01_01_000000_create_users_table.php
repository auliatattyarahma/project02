<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('unique_id')->unique()->nullable()->comment('Untuk NIS atau NIDN');
            $table->string('rombel')->nullable();
            $table->string('nomor_telp')->nullable();
            $table->string('photo')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->default('mahasiswa');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};