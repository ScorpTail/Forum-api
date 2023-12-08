<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'community_id',
        'title',
        'description',
        'image',
    ];

    public function hasUpvote(?string $user): ?bool
    {
        $tokenable = optional(PersonalAccessToken::findToken($user))->tokenable;

        if (!$tokenable || !$this->upvotes->contains('user_id', $tokenable->id)) {
            return null;
        }

        return $this->upvotes->where('user_id', $tokenable->id)->pluck('upvote')->first();
    }


    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function upvotes(): HasMany
    {
        return $this->hasMany(PostUpvote::class, 'post_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'saveds', 'post_id', 'user_id');
    }
}
