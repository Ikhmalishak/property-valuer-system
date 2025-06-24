<?php

namespace Database\Seeders;

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

        // Create invoices for client 1
        Invoice::create([
            'client_id' => $client1->id,
            'invoice_number' => 'INV001',
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
