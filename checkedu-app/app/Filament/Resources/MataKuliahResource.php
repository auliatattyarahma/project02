<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataKuliahResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MataKuliahResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $modelLabel = 'Mata Kuliah';
    protected static ?string $pluralModelLabel = 'Mata Kuliah';
    protected static ?string $navigationGroup = 'Akademik'; // Dikelompokkan di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Mata Kuliah')->required()->maxLength(20),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Mata Kuliah')->required()->maxLength(255),
                Forms\Components\TextInput::make('credits')
                    ->label('Jumlah SKS')->required()->numeric(),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Kode')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nama Mata Kuliah')->searchable(),
                Tables\Columns\TextColumn::make('credits')->label('SKS')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
