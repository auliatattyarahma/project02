<?php

namespace App\Filament\Admin\Resources\JadwalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    public function form(Form $form): Form
    {
        // Form ini tidak kita gunakan karena kita hanya akan melampirkan (attach)
        // data mahasiswa yang sudah ada, bukan membuat baru dari sini.
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Mahasiswa'),
                Tables\Columns\TextColumn::make('unique_id')->label('NIS'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tombol untuk "melampirkan" mahasiswa yang sudah ada ke jadwal ini
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect(), // Membuat pilihan mahasiswa mudah dicari
            ])
            ->actions([
                // Tombol untuk "melepas" mahasiswa dari jadwal ini
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
