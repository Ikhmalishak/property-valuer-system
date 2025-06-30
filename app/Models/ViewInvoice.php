<?php

// app/Models/Viewinvoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewinvoice extends Model
{
    protected $table = 'viewinvoices'; // name of your view
    protected $primaryKey = 'invoice_id'; // must match primary key in view
    public $incrementing = false; // if no auto-increment ID
    public $exists = true; // optional: tells Laravel it's read-only

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}