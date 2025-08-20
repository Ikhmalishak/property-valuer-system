<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
   protected $table = 'archives';
    protected $primaryKey = 'invoice_id'; // Use invoice_id as the primary key
    public $incrementing = false; // Since it's not auto-incrementing
    public $exists = true; // If archives is a read-only view

     // Define client relationship
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }
     public function property()
    {
        return $this->belongsTo(Property::class);
    }

    protected $casts = [
    'due_date' => 'datetime',
    'issued_date' => 'datetime',
];
}
