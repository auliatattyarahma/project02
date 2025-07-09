<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs'; // Pastikan nama tabelnya jika tidak sesuai konvensi

    protected $fillable = [
        'nama_mata_kuliah', 'kode_mata_kuliah', // contoh field mata kuliah
    ];

    // Relasi ke Jadwal (satu mata kuliah bisa memiliki banyak jadwal)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}