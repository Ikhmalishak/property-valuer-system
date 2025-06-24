<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            ['name' => 'Amanah Raya Berhad Ampang', 'email' => 'ampang@arb.com.my', 'branch' => 'Ampang'],
            ['name' => 'Amanah Raya Berhad Gerik', 'email' => 'gerik@arb.com.my', 'branch' => 'Gerik'],
            ['name' => 'Amanah Raya Berhad Johor Bahru', 'email' => 'jb@arb.com.my', 'branch' => 'Johor Bahru'],
        ];

        foreach ($clients as $clientData) {
            // Create the user first
            $user = User::create([
                'name' => $clientData['name'],
                'email' => $clientData['email'],
                'password' => Hash::make('password123'), // Default password (change as needed)
                'role' => 'client', // Optional: if you're using roles
            ]);

            // Then create the client and link to the user
            Client::create([
                'user_id' => $user->id,
                'name' => $clientData['name'],
                'email' => $clientData['email'],
                'branch' => $clientData['branch'],
            ]);
        }
    }
}
