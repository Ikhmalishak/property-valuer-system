<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archives'; // points to the view
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;
}
