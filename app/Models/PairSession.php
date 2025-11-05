<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PairSession extends Model
{
    protected $fillable = [
        'session_code',
        'driver_name',
        'navigator_name',
        'turn_duration',
        'current_role'
    ];
    
}
