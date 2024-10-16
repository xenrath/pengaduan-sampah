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
                'nik' => '3376026102990002',
                'telp' => '0895393395466',
                'verifikasi' => '1',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'nama' => 'Petugas',
                'nik' => 'petugas',
                'telp' => '085328481969',
                'verifikasi' => '1',
                'password' => bcrypt('petugas'),
                'role' => 'petugas',
            ],
            [
                'nama' => 'Dian',
                'nik' => 'pengguna',
                'telp' => 'pengguna',
                'verifikasi' => '1',
                'password' => bcrypt('pengguna'),
                'role' => 'pengguna',
            ],
        ];

        User::insert($users);
    }
}