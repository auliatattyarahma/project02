<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id',
        'lecturer_id',
        'class_name', // <-- INI YANG TERLEWAT SEBELUMNYA
        'day_of_week',
        'start_time',
        'end_time',
    ];

    // --- RELASI ELOQUENT ---

    /**
     * Satu jadwal kelas dimiliki oleh satu mata kuliah.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Satu jadwal kelas diajar oleh satu dosen (User).
     */
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    /**
     * Satu jadwal kelas diikuti oleh banyak mahasiswa (User).
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'schedule_id', 'student_id');
    }

    /**
     * Satu jadwal kelas memiliki banyak sesi pertemuan.
     */
    public function classSessions()
    {
        return $this->hasMany(ClassSession::class);
    }
}
