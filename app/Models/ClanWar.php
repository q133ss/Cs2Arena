<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClanWar extends Model
{
    protected $guarded = [];

    protected $casts = [
        'selected_maps' => 'array',
        'result' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function server()
    {
        return $this->hasOne(ClanWarServer::class, 'id', 'server_id');
    }

    public function clan1()
    {
        return $this->belongsTo(Clan::class, 'clan1_id');
    }

    public function clan2()
    {
        return $this->belongsTo(Clan::class, 'clan2_id');
    }
}
