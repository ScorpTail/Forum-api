<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Community extends Model
{
    use HasFactory;

    protected $table = 'communities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'type',
        'disclaimer',
        'avatar_path',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'disclaimer' => 'boolean',
    ];

    public function isSubscriber(User $user): bool
    {
        return $this->users->contains('id', $user->id);
    }

    public function setDisclaimerAttribute($value)
    {
        $this->attributes['disclaimer'] = boolval($value);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_communities', 'community_id', 'user_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'community_id', 'id');
    }
}
