<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 clients manually
        $client1 = Client::create([
            'name' => 'Ali Bin Ahmad',
            'email' => 'ali@example.com',
        ]);

        $client2 = Client::create([
            'name' => 'Siti Binti Amin',
            'email' => 'siti@example.com',
        ]);

        // Create invoices for client 1
        $invoice1 = Invoice::create([
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

        $invoice2 = Invoice::create([
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
        $invoice3 = Invoice::create([
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
