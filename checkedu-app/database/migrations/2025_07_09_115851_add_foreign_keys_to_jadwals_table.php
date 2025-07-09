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
            // Hapus kolom 'dosen' dan 'mata_kuliah' yang sebelumnya mungkin varchar
            $table->dropColumn(['dosen', 'mata_kuliah']); // Hapus jika sebelumnya sudah ada kolom ini

            // Tambahkan foreign key untuk dosen
            $table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade'); // asumsi nama tabel 'dosens'
            // Tambahkan foreign key untuk mata kuliah
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade'); // asumsi nama tabel 'mata_kuliahs'

            // Jika Anda punya tabel 'kelas' dan jadwal terkait kelas
            // $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign(['dosen_id']);
            $table->dropColumn('dosen_id');

            $table->dropForeign(['mata_kuliah_id']);
            $table->dropColumn('mata_kuliah_id');

            // Jika ada kelas_id
            // $table->dropForeign(['kelas_id']);
            // $table->dropColumn('kelas_id');

            // Opsional: Jika Anda ingin mengembalikan kolom varchar
            // $table->string('dosen')->nullable();
            // $table->string('mata_kuliah')->nullable();
        });
    }
};
