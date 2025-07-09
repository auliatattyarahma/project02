<?php

namespace App\Filament\Admin\Resources;

use Filament\Tables\Columns\TextColumn;

use App\Filament\Admin\Resources\JadwalResource\Pages;
use App\Filament\Admin\Resources\JadwalResource\RelationManagers;
use App\Models\Schedule;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TimePicker;

class JadwalResource extends Resource
{
    protected static ?string $model = Schedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $modelLabel = 'Jadwal';
    protected static ?string $pluralModelLabel = 'Jadwal';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Ganti 'nama_mata_kuliah' menjadi 'nama'
                Select::make('mata_kuliah_id')
                    ->label('Mata Kuliah')
                    ->relationship('mataKuliah', 'nama') // Pastikan 'nama' adalah nama kolom di tabel mata_kuliahs
                    ->searchable()
                    ->preload()
                    ->required(),

                // Kolom dosen (belum terlihat di screenshot ini, tapi pastikan juga namanya benar)
                Select::make('dosen_id')
                    ->label('Dosen')
                    ->relationship('dosen', 'nama') // Asumsi nama kolom dosen adalah 'nama', jika tidak, cek tabel dosens
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('kelas')
                    ->label('Kelas')
                    ->required()
                    ->maxLength(255),

                TextInput::make('hari')
                    ->label('Hari')
                    ->required()
                    ->maxLength(255),

                TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->required(),

                TimePicker::make('jam_akhir')
                    ->label('Jam Akhir')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Ganti 'mataKuliah.nama_mata_kuliah' menjadi 'mataKuliah.nama'
                TextColumn::make('mataKuliah.nama')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),

                // Kolom dosen (belum terlihat di screenshot ini, tapi pastikan juga namanya benar)
                TextColumn::make('dosen.nama') // Asumsi nama kolom dosen adalah 'nama', jika tidak, cek tabel dosens
                    ->label('Dosen')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hari')
                    ->label('Hari')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->time()
                    ->sortable(),

                TextColumn::make('jam_akhir') // Pastikan ini juga sudah ada jika Anda ingin menampilkan jam akhir
                    ->label('Jam Akhir')
                    ->time()
                    ->sortable(),
            ]);
    }

    // METHOD BARU UNTUK MENDAFTARKAN RELATION MANAGER
    public static function getRelations(): array
    {
        return [
            RelationManagers\StudentsRelationManager::class,
        ];
    }

    // METHOD getPages() YANG SUDAH DIPERBARUI
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'), // Relation Manager muncul di halaman edit
        ];
    }
}
