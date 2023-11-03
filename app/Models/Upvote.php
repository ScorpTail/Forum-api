<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upvote extends Model
{
    use HasFactory;
    protected $table = 'upvotes';

    protected $fillable = [
        'user_id',
        'post_id',
        'liked',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
