<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Math extends Model
{
    protected $guarded = [];

    protected $casts = [
        'result' => 'array'
    ];

    public function server()
    {
        return $this->hasOne(MixServer::class, 'id', 'server_id');
    }
}
