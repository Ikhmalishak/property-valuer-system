<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            ['name' => 'Amanah Raya Berhad Ampang', 'email' => 'ampang@arb.com.my', 'branch' => 'Ampang'],
            ['name' => 'Amanah Raya Berhad Gerik', 'email' => 'gerik@arb.com.my', 'branch' => 'Gerik'],
            ['name' => 'Amanah Raya Berhad Johor Bahru', 'email' => 'jb@arb.com.my', 'branch' => 'Johor Bahru'],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}

