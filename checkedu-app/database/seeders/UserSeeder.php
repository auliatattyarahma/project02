<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat User untuk Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@checkedu.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Membuat User untuk Dosen pertama
        $userDosen = User::create([
            'name' => 'Dr. Amalia Rahmah, S.T., M.T.', // Nama ini akan muncul di login
            'email' => 'amaliarahmah@universitas.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        // Membuat profil Dosen yang terhubung dengan User di atas
        Dosen::create([
            'user_id' => $userDosen->id,
            'name' => 'Dr. Amalia Rahmah, S.T., M.T.', // Nama ini akan tampil di resource
            'nip' => '402018701',
            'jenis_kelamin' => 'Perempuan',
        ]);
    }
}