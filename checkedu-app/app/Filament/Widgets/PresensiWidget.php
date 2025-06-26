<?php

namespace App\Filament\Widgets;

use App\Models\AttendanceRecord; // <--- PASTIKAN BARIS INI ADA
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PresensiWidget extends BaseWidget
{
    protected static ?string $heading = 'Tabel Presensi';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AttendanceRecord::query()->with(['student', 'classSession.schedule.course'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('nomor_urut')
                    ->label('Absen')
                    ->state(static function (Table $table, $rowLoop): string {
                        return (string) ($rowLoop->index + 1 + ($table->getPage() - 1) * $table->getPaginationPageOptions()[0]);
                    }),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.unique_id')
                    ->label('NIS'),
                Tables\Columns\TextColumn::make('classSession.schedule.course.name')
                    ->label('Kelas / Matkul'),
                SelectColumn::make('status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpha',
                        'terlambat' => 'Terlambat',
                    ])->rules(['required']),
            ]);
    }
}
