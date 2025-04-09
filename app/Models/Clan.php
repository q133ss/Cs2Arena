<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    protected $guarded = [];

    public function members()
    {
        return $this->belongsToMany(User::class, 'clan_members');
    }

    public function mathes()
    {
        return ClanWar::where('clan1_id', $this->id)
            ->orWhere('clan2_id', $this->id)
            ->get();
    }
}
