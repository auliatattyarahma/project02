<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_session_id')->constrained('class_sessions')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa', 'terlambat'])->default('alpa');
            $table->timestamp('scan_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['class_session_id', 'student_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('attendance_records'); }
};