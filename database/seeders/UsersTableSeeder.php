<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Ana',
                'email' => 'admin@demo.com',
                'nip' => '2110131320009',
                'nisn' => null,
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-05-05 18:55:00',
                'updated_at' => '2025-05-05 18:55:00'
            ],
            [
                'id' => 5,
                'name' => 'Santy Rahayu',
                'email' => 'santi@gmail.com',
                'nip' => null,
                'nisn' => '0019273846',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-05-21 07:15:28',
                'updated_at' => '2025-07-02 17:07:30'
            ],
            [
                'id' => 6,
                'name' => 'Ayudia Rahmah',
                'email' => 'ayu@gmail.com',
                'nip' => null,
                'nisn' => '0024857310',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-05-22 21:39:56',
                'updated_at' => '2025-06-25 19:16:20'
            ],
            [
                'id' => 7,
                'name' => 'Uyara Citra Sari',
                'email' => 'uya@gmail.com',
                'nip' => null,
                'nisn' => '0036712598',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-05-28 08:20:11',
                'updated_at' => '2025-06-25 19:19:17'
            ],
            [
                'id' => 8,
                'name' => 'Nova Riesa',
                'email' => 'nopa@gmail.com',
                'nip' => null,
                'nisn' => '0043826159',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-05-28 23:07:04',
                'updated_at' => '2025-06-25 19:19:49'
            ],
            [
                'id' => 9,
                'name' => 'Sri Ningsih Pratama',
                'email' => 'sri@gmail.com',
                'nip' => null,
                'nisn' => '0057482316',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-05-28 23:30:25',
                'updated_at' => '2025-06-25 19:20:20'
            ],
            [
                'id' => 10,
                'name' => 'Nia Karina',
                'email' => 'nia@gmail.com',
                'nip' => null,
                'nisn' => '0069352478',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-06-03 07:27:41',
                'updated_at' => '2025-06-25 19:20:52'
            ],
            [
                'id' => 12,
                'name' => 'Karine Putri',
                'email' => 'karin@gmail.com',
                'nip' => null,
                'nisn' => '0074268135',
                'password' => Hash::make('password'),
                'status' => 1,
                'created_at' => '2025-06-18 21:47:17',
                'updated_at' => '2025-06-25 19:21:19'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
