<?php

namespace App\Models;

use App\Notifications\InvoiceReminder;
use App\Notifications\PropertyReminder;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'user_id',
        'property_id',
        'invoice_number',
        'amount',
        'due_date',
        'status',
        'issued_date',
        'reminder_frequency',
        'last_reminder_sent',
        'amanah_raya_paid',
        'file_name',
        'file_type',
        'file_path',
           // New files
    'file_path2',
    'file_name2',
    'file_path3',
    'file_name3',
    ];

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
        'last_reminder_sent' => 'datetime',
        'amount' => 'decimal:2', // optional: if you want money precision
    ];
    
    public function sendFirstReminder()
    {
        $this->client->notify(new InvoiceReminder($this));
        $this->last_reminder_sent = now();
        $this->is_reminder_sent = true;
        $this->save();
    }
    public function sendRecurringReminder()
    {
        $this->client->notify(new PropertyReminder($this));
        $this->last_reminder_sent = now();
        $this->save();
    }
}
