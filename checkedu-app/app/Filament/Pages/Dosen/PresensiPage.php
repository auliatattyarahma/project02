<?php

namespace App\Filament\Pages\Dosen;

use App\Models\Mahasiswa;
use Filament\Pages\Page;

class PresensiPage extends Page
{
    protected static ?string $navigationLabel = 'Presensi';
    protected static ?string $navigationGroup = 'Presensi';
    protected static string $view = 'filament.pages.dosen.presensi-page';

    public $mahasiswaList;

    public function mount()
    {
        // Ambil semua data mahasiswa (nanti bisa disaring per jadwal)
        $this->mahasiswaList = Mahasiswa::all();
    }
}
