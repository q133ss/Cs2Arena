<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $guarded = [];
    protected $casts = [
        'accepted_divisions' => 'array'
    ];
}
