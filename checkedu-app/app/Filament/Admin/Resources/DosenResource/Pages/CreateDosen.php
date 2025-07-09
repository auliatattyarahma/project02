<?php

namespace App\Filament\Admin\Resources\DosenResource\Pages;

use App\Filament\Admin\Resources\DosenResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateDosen extends CreateRecord
{
    protected static string $resource = DosenResource::class;

    // Kita akan menimpa (override) data sebelum disimpan
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Buat User baru untuk login
        $user = User::create([
            'name' => $data['name'], // Ambil nama dari form
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'dosen', // Atur perannya sebagai dosen
        ]);

        // 2. Tambahkan user_id ke data yang akan disimpan ke tabel dosens
        $data['user_id'] = $user->id;

        return $data;
    }
}
