<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\PresensiTableWidget;
use Filament\Pages\Page;

class Presensi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static string $view = 'filament.pages.presensi';
    protected static ?string $navigationLabel = 'Presensi';
    protected static ?string $title = 'Laporan Presensi';

    protected function getHeaderWidgets(): array
    {
        return [
            PresensiTableWidget::class,
        ];
    }
}
