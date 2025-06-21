<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['client_id', 'type', 'address', 'description'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
