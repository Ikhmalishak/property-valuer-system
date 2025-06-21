<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            Property::create([
                'client_id' => $client->id,
                'type' => 'House',
                'address' => '123 Jalan Example, ' . $client->branch,
                'description' => 'Main property for ' . $client->name,
            ]);

            Property::create([
                'client_id' => $client->id,
                'type' => 'Land',
                'address' => 'Lot 456 Kampung Example, ' . $client->branch,
                'description' => 'Additional land asset for ' . $client->name,
            ]);
        }
    }
}

