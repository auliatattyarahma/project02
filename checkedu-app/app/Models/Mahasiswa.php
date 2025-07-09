<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jurusan',
        'photo',
        'rombel', // <-- Tambahkan ini
        'nomor_telepon', // <-- Tambahkan ini
    ];
}
