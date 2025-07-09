<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MataKuliahResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MataKuliahResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $modelLabel = 'Mata Kuliah';
    protected static ?string $pluralModelLabel = 'Mata Kuliah';
    protected static ?string $navigationGroup = 'Akademik';

    /**
     * Mengatur form untuk membuat dan mengedit data.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Mata Kuliah')->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Mata Kuliah')->required(),
                Forms\Components\TextInput::make('credits')
                    ->label('Jumlah SKS')->required()->numeric(),
                // Field 'Deskripsi' sudah dihapus dari sini
            ]);
    }

    /**
     * Mengatur tabel untuk menampilkan daftar data.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. KOLOM NOMOR URUT DITAMBAHKAN
                Tables\Columns\TextColumn::make('No.')
                    ->rowIndex(),

                // Kolom data Anda
                Tables\Columns\TextColumn::make('code')->label('Kode')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nama Mata Kuliah')->searchable(),
                Tables\Columns\TextColumn::make('credits')->label('SKS')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            // 2. BAGIAN BULKACTIONS DIHAPUS UNTUK MENGHILANGKAN CHECKBOX
        ;
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
            'index' => Pages\ListMataKuliahs::route('/'),
            'create' => Pages\CreateMataKuliah::route('/create'),
            'edit' => Pages\EditMataKuliah::route('/{record}/edit'),
        ];
    }
}
