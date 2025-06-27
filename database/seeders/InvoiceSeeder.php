<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        // Create user and client 1
        $user1 = User::create([
            'name' => 'Amanah Raya Berhad Gerik',
            'email' => 'ali@example.com',
            'password' => Hash::make('password123'),
            'role' => 'client',
        ]);

        $client1 = Client::create([
            'user_id' => $user1->id,
            'name' => 'Amanah Raya Berhad Gerik',
            'email' => 'ali@example.com',
            'branch' => 'Gerik',
        ]);

        $property1 = Property::create([
            'client_id' => $client1->id,
            'nombor_kait' => 'KAIT' . str_pad(2 + 1, 3, '0', STR_PAD_LEFT),
            'nombor_lot' => 'LOT' . str_pad(2 + 1, 3, '0', STR_PAD_LEFT),
            'nombor_geran' => 'GERAN' . str_pad(2 + 1, 3, '0', STR_PAD_LEFT),
            'daerah' => 'Pontian',
            'mukim' => 'Mukim A',
            'file_name' => 'INV001.pdf',
            'file_path' => 'invoices/INV001.pdf',
        ]);

        // Create user and client 2
        $user2 = User::create([
            'name' => 'Amanah Raya Berhad Ampang',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'role' => 'client',
        ]);

        $client2 = Client::create([
            'user_id' => $user2->id,
            'name' => 'Amanah Raya Berhad Ampang',
            'email' => 'siti@example.com',
            'branch' => 'Ampang',
        ]);

        $property2 = Property::create([
            'client_id' => $client2->id,
            'nombor_kait' => 'KAIT' . str_pad(2 + 1, 3, '0', STR_PAD_LEFT),
            'nombor_lot' => 'LOT' . str_pad(2 + 1, 3, '0', STR_PAD_LEFT),
            'nombor_geran' => 'GERAN' . str_pad(2 + 1, 3, '0', STR_PAD_LEFT),
            'daerah' => 'Pontian',
            'mukim' => 'Mukim A',
            'file_name' => 'INV001.pdf',
            'file_path' => 'invoices/INV001.pdf',
        ]);

        // Create invoices for client 1
        Invoice::create([
            'client_id' => $client1->id,
            'invoice_number' => 'INV001',
            'property_id' => $property1->id,
            'amount' => 500.00,
            'due_date' => now()->addDays(30),
            'status' => 'pending',
            'issued_date' => now(),
            'reminder_frequency' => 'monthly',
            'last_reminder_sent' => null,
            'amanah_raya_paid' => false,
            'file_name' => 'INV001.pdf',
            'file_path' => 'invoices/INV001.pdf',
        ]);

        Invoice::create([
            'client_id' => $client1->id,
            'invoice_number' => 'INV002',
            'property_id' => $property1->id,
            'amount' => 750.00,
            'due_date' => now()->addDays(15),
            'status' => 'paid',
            'issued_date' => now()->subDays(10),
            'reminder_frequency' => 'none',
            'last_reminder_sent' => null,
            'amanah_raya_paid' => true,
            'file_name' => 'INV002.pdf',
            'file_path' => 'invoices/INV002.pdf',
        ]);

        // Create invoice for client 2
        Invoice::create([
            'client_id' => $client2->id,
            'property_id' => $property1->id,
            'invoice_number' => 'INV003',
            'amount' => 1200.00,
            'due_date' => now()->addDays(10),
            'status' => 'overdue',
            'issued_date' => now()->subDays(20),
            'reminder_frequency' => 'weekly',
            'last_reminder_sent' => now()->subDays(7),
            'amanah_raya_paid' => false,
            'file_name' => 'INV003.pdf',
            'file_path' => 'invoices/INV003.pdf',
        ]);
    }
}
