<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Community;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'nickName',
        'email',
        'password',
        'about',
        'avatar',
        'baner',
        'flags',
        'provider',
        'provider_id',
        'provider_token',
        'provider_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->role()->where('name', Role::ADMIN)->exists();
    }

    public function isBanned(): bool
    {
        return $this->bannedUser()->exists();
    }

    public function isUserUpvoted(Model $model): bool
    {
        return $model->upvotes->contains('user_id', $this->id);
    }

    public function ownCommunities()
    {
        return $this->hasMany(Community::class, 'user_id', 'id');
    }

    public function subscribed(): BelongsToMany
    {
        return $this->belongsToMany(Community::class, 'user_communities', 'user_id', 'community_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }

    public function upvotes(): HasMany
    {
        return $this->hasMany(PostUpvote::class, 'user_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function bannedUser(): HasOne
    {
        return $this->hasOne(BannedUser::class, 'user_id', 'id');
    }
}
