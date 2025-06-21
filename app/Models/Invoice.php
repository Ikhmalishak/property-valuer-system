<?php

namespace App\Models;

use App\Notifications\InvoiceReminder;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'user_id',
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

    public function sendReminder(){
        $this->client->notify(new InvoiceReminder($this));
    }
}
