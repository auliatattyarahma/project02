<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Filament\Resources\DosenResource\RelationManagers;
use App\Models\Dosen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash; // <-- Pastikan ini ada

class DosenResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Daftar Dosen';
    protected static ?string $navigationGroup = 'Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk upload foto
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Dosen')
                    ->image()
                    ->directory('dosen-photos') // Folder penyimpanan foto
                    ->columnSpanFull(),

                // Field untuk Nama
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),

                // Field untuk NIDN
                Forms\Components\TextInput::make('nidn')
                    ->label('NIDN')
                    ->required()
                    ->unique(ignoreRecord: true) // Pastikan NIDN unik
                    ->maxLength(255),

                // Field untuk Email
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true) // Pastikan email unik
                    ->maxLength(255),

                // Field untuk Password
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk menampilkan foto
                Tables\Columns\ImageColumn::make('photo')->label('Foto'),

                // Kolom untuk menampilkan Nama
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),

                // Kolom untuk menampilkan NIDN
                Tables\Columns\TextColumn::make('nidn')
                    ->label('NIDN')
                    ->searchable(),

                // Kolom untuk menampilkan Email
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
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}