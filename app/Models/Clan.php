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

    public function winsCount()
    {
        $count = ClanWar::where('clan1_id', $this->id)
            ->orWhere('clan2_id', $this->id)
            ->count();

        // Отнимаем 20% и округляем до целого числа
        $result = round($count * 0.8);

        return $result;
    }
}
