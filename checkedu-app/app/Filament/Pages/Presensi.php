<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PresensiWidget; // <-- Pastikan nama widget ini benar
use Filament\Pages\Page;

class Presensi extends Page
{
    // Tampilan Blade yang akan digunakan (dibuat otomatis)
    protected static string $view = 'filament.pages.presensi';

    // Pengaturan untuk menu di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Presensi';
    protected static ?int $navigationSort = -1; // Agar posisinya di paling atas setelah Dashboard

    // Judul yang akan tampil di dalam halaman
    protected static ?string $title = 'Laporan Presensi';

    /**
     * Mendefinisikan widget yang akan tampil di bagian atas halaman ini.
     */
    protected function getHeaderWidgets(): array
    {
        return [
            // Daftarkan widget presensi kita di sini
            PresensiWidget::class,
        ];
    }
}
