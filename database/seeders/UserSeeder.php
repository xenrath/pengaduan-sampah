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
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'nama' => 'Petugas',
                'nik' => '321830218393291',
                'telp' => '085328481969',
                'password' => bcrypt('petugas'),
                'role' => 'petugas',
            ],
            [
                'nama' => 'Dian',
                'nik' => '321830218393292',
                'telp' => '087730105844',
                'password' => bcrypt('pengguna'),
                'role' => 'user',
            ],
        ];

        User::insert($users);
    }
}
