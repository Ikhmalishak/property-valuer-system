<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            for ($i = 1; $i <= 2; $i++) {
                Invoice::create([
                    'client_id' => $client->id,
                    'invoice_number' => strtoupper(Str::random(10)),
                    'amount' => rand(1000, 5000),
                    'due_date' => Carbon::now()->addDays(14),
                    'status' => 'pending',
                    'issued_date' => Carbon::now()->subDays(3),
                    'reminder_frequency' => 'monthly',
                    'last_reminder_sent' => null,
                    'amanah_raya_paid' => false,
                    'file_name' => "invoice{$i}.pdf",
                    'file_type' => 'pdf',
                    'file_path' => "invoices/invoice{$i}.pdf",
                ]);
            }
        }
    }
}

