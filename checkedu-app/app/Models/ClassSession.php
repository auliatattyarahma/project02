<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'schedule_id',
        'session_date',
        'topic',
        'qr_code_token',
        'qr_code_expires_at',
    ];

    // --- RELASI ELOQUENT ---

    // Satu sesi pertemuan dimiliki oleh satu jadwal kelas
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // Satu sesi pertemuan memiliki banyak rekaman absensi
    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}