<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AttendanceRecord;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PresensiTableWidget extends BaseWidget
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
                Tables\Columns\TextColumn::make('student.name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('student.unique_id')->label('NIS'),
                Tables\Columns\TextColumn::make('classSession.schedule.course.name')->label('Kelas'),
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
