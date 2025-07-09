<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class JadwalSaya extends Page
{
    protected static string $view = 'filament.pages.jadwal-saya';

    public $jadwals;

    public function mount(): void
    {
        $this->jadwals = Auth::user()->dosen
            ? Auth::user()->dosen->jadwals()->with('mataKuliah')->get()
            : collect();
    }
}
