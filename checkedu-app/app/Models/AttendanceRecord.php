<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'class_session_id',
        'student_id',
        'status',
        'scan_time',
        'notes',
    ];

    // --- RELASI ELOQUENT ---

    // Satu rekaman absensi dimiliki oleh satu sesi pertemuan
    public function classSession()
    {
        return $this->belongsTo(ClassSession::class);
    }

    // Satu rekaman absensi dimiliki oleh satu mahasiswa (User)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}