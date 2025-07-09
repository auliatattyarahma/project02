<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DosenResource\Pages;
use App\Models\Dosen; // <-- MODEL DIUBAH KE DOSEN
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class; // <-- MODEL DIUBAH KE DOSEN

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $modelLabel = 'Dosen';
    protected static ?string $pluralModelLabel = 'Daftar Dosen';
    protected static ?string $navigationGroup = 'Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input untuk data login (tabel users)
                Forms\Components\TextInput::make('email')
                    ->label('Email Login')
                    ->email()
                    ->required()
                    ->unique(table: \App\Models\User::class, column: 'email', ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->visibleOn('create'),

                // Input untuk data profil (tabel dosens)
                Forms\Components\Section::make('Informasi Profil Dosen')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto Dosen')
                            ->image()->directory('dosen-photos'),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap & Gelar')
                            ->required(),
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->unique(table: \App\Models\Dosen::class, column: 'nip', ignoreRecord: true),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\ImageColumn::make('photo')->label('Foto')->circular(),
                Tables\Columns\TextColumn::make('nip')->label('NIP')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nama Dosen')->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('user.email')->label('Email Login')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
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
