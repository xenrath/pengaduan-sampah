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
                'nik' => '321830218393291',
                'telp' => '08083021931',
                'role' => 'admin',
            ],
            [
                'nama' => 'Petugas',
                'nik' => '321830218393291',
                'telp' => '08083021931',
                'role' => 'petugas',
            ],
            [
                'nama' => 'Dian',
                'nik' => '321830218393291',
                'telp' => '08083021931',
                'role' => 'user',
            ],
        ];

        User::insert($users);
    }
}
