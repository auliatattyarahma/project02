<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id', // Ubah dari 'dosen' ke 'dosen_id'
        'mata_kuliah_id', // Ubah dari 'mata_kuliah' ke 'mata_kuliah_id'
        'kelas',
        'hari',
        'jam_mulai',
        'jam_akhir',
        // ... bidang lainnya
    ];

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    // Relasi ke MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    // Jika ada relasi ke Kelas
    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }
}