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
    // app/Models/Property.php

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'property_id');
    }
protected $casts = [
    'created_at' => 'datetime', 
    // Add any other date fields if needed, e.g.
    'date_of_acquisition' => 'datetime', // example
];

}
