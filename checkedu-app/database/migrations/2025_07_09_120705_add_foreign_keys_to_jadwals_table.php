<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            // Hapus atau komentari baris ini karena kolomnya sudah ada
            // $table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade');
            // $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
    
            // Hanya tambahkan foreign key constraint jika kolomnya sudah ada tapi constraint-nya belum
            // Pastikan tipe data kolomnya (bigint unsigned) sudah cocok dengan foreignId
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign(['dosen_id']);
            $table->dropColumn('dosen_id'); // <-- Hapus atau komentari ini juga jika kolom tidak dihapus di up()
            $table->dropForeign(['mata_kuliah_id']);
            $table->dropColumn('mata_kuliah_id'); // <-- Hapus atau komentari ini juga jika kolom tidak dihapus di up()
        });
    }
};