<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';

    protected $fillable = [
        'kode',
        'nama',
        'kelas',
        'program_studi',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
