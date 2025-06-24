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

        foreach ($clients as $index => $client) {
            Property::create([
                'client_id' => $client->id,
                'nombor_kait' => 'KAIT' . str_pad($index * 2 + 1, 3, '0', STR_PAD_LEFT),
                'nombor_lot' => 'LOT' . str_pad($index * 2 + 1, 3, '0', STR_PAD_LEFT),
                'nombor_geran' => 'GERAN' . str_pad($index * 2 + 1, 3, '0', STR_PAD_LEFT),
                'daerah' => 'Pontian',
                'mukim' => 'Mukim A',
                'file_name' => 'INV001.pdf',
                'file_path' => 'invoices/INV001.pdf',
            ]);

            Property::create([
                'client_id' => $client->id,
                'nombor_kait' => 'KAIT' . str_pad($index * 2 + 2, 3, '0', STR_PAD_LEFT),
                'nombor_lot' => 'LOT' . str_pad($index * 2 + 2, 3, '0', STR_PAD_LEFT),
                'nombor_geran' => 'GERAN' . str_pad($index * 2 + 2, 3, '0', STR_PAD_LEFT),
                'daerah' => 'Pontian',
                'mukim' => 'Mukim B',
                'file_name' => 'INV001.pdf',
                'file_path' => 'invoices/INV001.pdf',
            ]);
        }
    }
}
