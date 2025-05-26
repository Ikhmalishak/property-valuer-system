<?php

namespace Database\Seeders;

// database/seeders/ServiceSeeder.php
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Property Tax Payment',
                'description' => 'Annual tax for residential/commercial properties.',
                'price' => 500.00,
                'is_active' => true,
            ],
            [
                'name' => 'Housing Consultation Fee',
                'description' => 'Professional advice on housing schemes.',
                'price' => 100.00,
                'is_active' => true,
            ],
            [
                'name' => 'Land Registration Fee',
                'description' => 'Fee for registering new land ownership.',
                'price' => 200.00,
                'is_active' => true,
            ],
            [
                'name' => 'Building Permit',
                'description' => 'Approval for new construction projects.',
                'price' => 300.00,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}