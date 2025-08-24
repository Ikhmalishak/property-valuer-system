<?php

namespace App\Models;

use App\Notifications\InvoiceReminder;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'user_id',
        'property_id',
        'invoice_number',
        'amount',
        'status',
        'issued_date',
        'reminder_frequency',
        'due_date',
        'amanah_raya_paid',
        'file_name',
        'file_type',
        'file_path',
           // New files
    'file_path2',
    'file_name2',
    'file_path3',
    'file_name3',
     'reminders_sent_count',
    ];

    // Optional: helper to get current file path based on reminder count
public function getCurrentInvoiceFilePath()
{
    $count = $this->reminders_sent_count;

    // Map count to file path field
    $field = match (true) {
        $count === 0 => 'file_path',
        $count === 1 => 'file_path2',
        $count >= 2 => 'file_path3', // Use file_path_3 for all subsequent
        default => 'file_path',
    };

    return $this->{$field};
}

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class, 'property_id');
    }

      protected $casts = [
        'due_date' => 'datetime',
        'issued_date' => 'datetime',
        'amount' => 'decimal:2', // optional: if you want money precision
    ];

    public function sendFirstReminder()
    {
        $this->client->notify(new InvoiceReminder($this));
        $this->is_reminder_sent = true;
        $this->save();
    }
   public function sendRecurringReminder()
{
    // Only send if client exists and has valid email
    if (!$this->client || !$this->client->email) {
        return;
    }

    // ✅ Send the correct invoice reminder
    $this->client->notify(new \App\Notifications\InvoiceReminder($this));
}
}
