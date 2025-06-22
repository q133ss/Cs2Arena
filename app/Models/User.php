<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'steam_id',
        'username',
        'avatar_url',
        'social_links',
        'country',
        'rank_mix',
        'rank_cw',
        'deleted_at',
        'is_deleted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class,'user_id', 'id');
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'user1_id', 'id')
            ->orWhere('user2_id', $this->id);
    }

    public function friends(string $status = 'accepted')
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->where(function ($query) use ($status) {
                $query->where(function ($q) use ($status) {
                    $q->where('friendships.user_id', auth()->id())
                        ->where('friendships.status', $status);
                })->orWhere(function ($q) use ($status) {
                    $q->where('friendships.friend_id', auth()->id())
                        ->where('friendships.status', $status);
                });
            })
            ->withPivot('status')
            ->withTimestamps();
    }

    public function clan(): BelongsToMany
    {
        return $this->belongsToMany(Clan::class, 'clan_members')
            ->withPivot('role');
    }

    public function mathes()
    {
        return $this->belongsToMany(Math::class, 'user_maths');
    }

    // Заявки в клан
    public function clanApplications()
    {
        return $this->hasMany(ClanApplication::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
