<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MahasiswaResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MahasiswaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Daftar Mahasiswa';
    protected static ?string $navigationGroup = 'Pengguna';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'mahasiswa');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nama')->required(),
                Forms\Components\TextInput::make('unique_id')->label('NIM')->required()->unique(ignoreRecord: true),
                Forms\Components\Select::make('rombel')->label('Rombel')
                    ->options(array_combine(range(1, 12), range(1, 12)))->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nomor_telp')->label('Nomor Telepon')->tel()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_urut')
                    ->label('No.')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('unique_id')->label('NIS')->searchable(),
                Tables\Columns\TextColumn::make('rombel')->label('Rombel')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('nomor_telp')->label('Nomor Telepon')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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
