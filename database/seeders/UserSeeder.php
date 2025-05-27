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
                'email' => 'ikhmal@gmail.com',
                'password' => '12345678'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'nim@gmail.com',
                'password' => '12345678'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
