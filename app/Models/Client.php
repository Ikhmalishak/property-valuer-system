<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    //add notifable
    use Notifiable;
    
    protected $fillable = ['name', 'email', 'branch'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}

