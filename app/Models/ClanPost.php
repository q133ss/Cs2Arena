<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClanPost extends Model
{
    protected $guarded = [];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }
}
