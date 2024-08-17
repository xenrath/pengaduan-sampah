<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'nama' => 'Admin',
                // 'nik' => '3376026102990002',
                'nik' => 'admin',
                'telp' => '0895393395466',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'nama' => 'Petugas',
                'nik' => 'petugas',
                'telp' => '085328481969',
                'password' => bcrypt('petugas'),
                'role' => 'petugas',
            ],
            [
                'nama' => 'Dian',
                'nik' => 'pengguna',
                'telp' => '087730105844',
                'password' => bcrypt('pengguna'),
                'role' => 'user',
            ],
        ];

        User::insert($users);
    }
}
