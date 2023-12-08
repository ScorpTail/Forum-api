<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'comment',
    ];

    public function hasUpvote(?string $user): ?bool
    {
        $tokenable = optional(PersonalAccessToken::findToken($user))->tokenable;

        if (!$tokenable || !$this->upvotes->contains('user_id', $tokenable->id)) {
            return null;
        }

        return $this->upvotes->where('user_id', $tokenable->id)->pluck('upvote')->first();
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function upvotes(): HasMany
    {
        return $this->hasMany(CommentUpvote::class, 'comment_id', 'id');
    }
}
