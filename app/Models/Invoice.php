<?php

namespace App\Models;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
