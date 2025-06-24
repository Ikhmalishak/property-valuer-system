<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //user

        $users = [
            [
                'name' => 'Ikhmal',
                'email' => 'Ikhmal1410@gmail.com',
                'password' => '12345678',
                'role' => 'admin'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'nim@gmail.com',
                'password' => '12345678',
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
