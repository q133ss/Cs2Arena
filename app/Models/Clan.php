<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // Заявки на добавление в клан
    public function applications(): HasMany
    {
        return $this->hasMany(ClanApplication::class);
    }

    public function posts()
    {
        return $this->hasMany(ClanPost::class);
    }
}
