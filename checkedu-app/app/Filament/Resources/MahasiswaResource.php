<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input untuk Nama
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),

                // Input untuk NIM
                Forms\Components\TextInput::make('nim')
                    ->required()
                    ->unique(ignoreRecord: true),

                // Input untuk Kelas
                Forms\Components\TextInput::make('kelas')
                    ->required()
                    ->maxLength(255),

                // Input untuk Email
                Forms\Components\TextInput::make('email')
                    ->email() // Validasi format email
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk Nama
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk NIM
                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),

                // Kolom untuk Kelas
                Tables\Columns\TextColumn::make('kelas')
                    ->searchable(),

                // Kolom untuk Email
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
