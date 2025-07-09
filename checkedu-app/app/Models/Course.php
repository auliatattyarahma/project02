<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'credits',
    ];

    // --- RELASI ELOQUENT ---

    // Satu mata kuliah bisa memiliki banyak jadwal kelas
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}