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
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
{
    return $this->belongsTo(\App\Models\Property::class, 'property_id');
}

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
