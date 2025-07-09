<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nidn', 'email', 'foto' // contoh field dosen
    ];

    // Relasi ke Jadwal (seorang dosen bisa memiliki banyak jadwal)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}