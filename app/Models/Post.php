<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
}
