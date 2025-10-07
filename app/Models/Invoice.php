<?php

namespace App\Models;

use App\Notifications\InvoiceReminder;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // ✅ Use correct primary key
    protected $primaryKey = 'invoice_id';

    // ✅ Important: if your key is BIGINT, ensure incrementing is true
    public $incrementing = true;
    protected $keyType = 'int'; // or 'bigint' if needed

    // ✅ Fillable attributes
    protected $fillable = [
        'user_id',
        'property_id',
        'invoice_number',
        'amount',
        'status',
        'issued_date',
        'due_date',
        'reminder_frequency',
        'amanah_raya_paid', 
        'reminders_sent_count',
        'last_reminder_sent_at',
        // File fields
        'file_name',
        'file_type',
        'file_path',
        'file_name2',
        'file_path2',
        'file_name3',
        'file_path3',
    ];

    // ✅ Casts for proper type handling
    protected $casts = [
        'due_date' => 'datetime',
        'issued_date' => 'datetime',
        'amount' => 'decimal:2',
        'reminders_sent_count' => 'integer',
        'last_reminder_sent_at' => 'datetime',
    ];

    // ✅ Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // ✅ Get current invoice file based on reminder count
    public function getCurrentInvoiceFilePath()
    {
        $count = $this->reminders_sent_count;

        $field = match (true) {
            $count === 0 => 'file_path',
            $count === 1 => 'file_path2',
            $count >= 2 => 'file_path3',
            default => 'file_path',
        };

        return $this->{$field};
    }

    // ✅ Send first reminder (used in older logic)
    public function sendFirstReminder()
    {
        if (!$this->client) {
            return;
        }

        $this->client->notify(new InvoiceReminder($this));
        $this->is_reminder_sent = true;
        $this->reminders_sent_count = 1; // Track properly
        $this->last_reminder_sent_at = now();
        $this->save();
    }

    // ✅ Send recurring reminder (used by SendInvoiceReminders command)
    public function sendRecurringReminder(): bool
    {
        if (!$this->client || !$this->client->email) {
            return false;
        }

        try {
            $this->client->notify(new InvoiceReminder($this));
            // Mark as sent only if no exception is thrown
            $this->is_reminder_sent = true;
            $this->increment('reminders_sent_count'); // +1
            $this->last_reminder_sent_at = now();
            $this->save();

            return true;
        } catch (\Throwable $e) {
            \Log::error('Invoice reminder send failed', [
                'invoice_id' => $this->invoice_id ?? $this->id ?? null,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}