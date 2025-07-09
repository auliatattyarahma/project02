<?php

namespace App\Filament\Resources;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Dosen;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\JadwalResource\Pages;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Jadwal';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('mata_kuliah_id')
                ->label('Mata Kuliah')
                ->options(MataKuliah::pluck('nama', 'id'))
                ->searchable()
                ->required(),

            Select::make('dosen_id')
                ->label('Dosen')
                ->options(Dosen::pluck('nama', 'id'))
                ->searchable()
                ->required(),

            TextInput::make('kelas')->required(),
            TextInput::make('hari')->required(),

            TimePicker::make('jam_mulai')
                ->label('Jam Mulai')
                ->seconds(false)
                ->required(),

            TimePicker::make('jam_akhir')
                ->label('Jam Akhir')
                ->seconds(false)
                ->required(),


            TextInput::make('ruangan')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn(Builder $query) => $query->where('dosen_id', Auth::user()->id)) // <--- tambahin ini
            ->columns([
                Tables\Columns\TextColumn::make('mataKuliah.nama')->label('Mata Kuliah'),
                Tables\Columns\TextColumn::make('dosen.nama')->label('Dosen'),
                Tables\Columns\TextColumn::make('kelas'),
                Tables\Columns\TextColumn::make('hari'),
                Tables\Columns\TextColumn::make('jam')->label('Jam')->getStateUsing(function ($record) {
                    return Carbon::parse($record->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($record->jam_akhir)->format('H:i');
                }),
                Tables\Columns\TextColumn::make('ruangan')->label('Ruangan'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'),
        ];
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->role === 'admin';
    }

    public static function canCreate(): bool
    {
        return Auth::user()->role === 'admin';
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->role === 'admin';
    }
}
