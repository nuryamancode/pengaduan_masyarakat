<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('password', PASSWORD_DEFAULT);

        $data = [
            [
                'nama' => 'Admin User',
                'email' => 'admin@example.com',
                'tempat' => 'City',
                'tgl_lahir' => '1980-01-01',
                'username' => 'admin',
                'jenis_kelamin' => 'laki-laki',
                'password' => $password,
                'level' => 'admin',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Regular User',
                'email' => 'user@example.com',
                'tempat' => 'City',
                'tgl_lahir' => '1990-01-01',
                'username' => 'user',
                'jenis_kelamin' => 'perempuan',
                'password' => $password,
                'level' => 'user',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Police User',
                'email' => 'polisi@example.com',
                'tempat' => 'City',
                'tgl_lahir' => '1985-01-01',
                'username' => 'polisi',
                'jenis_kelamin' => 'laki-laki',
                'password' => $password,
                'level' => 'polisi',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
