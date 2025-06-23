<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClanWarServer extends Model
{
    protected $guarded = [];

    public function clanWars()
    {
        return $this->hasMany(ClanWar::class, 'server_id');
    }
}
