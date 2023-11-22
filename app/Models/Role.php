<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    public const ADMIN = 'admin';
    public const ADMIN_ID = 1;
    public const MODERATOR = 'moderator';
    public const MODERATOR_ID = 2;
    public const USER = 'user';
    public const USER_ID = 3;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function permissions(): BelongsToMany
    {
        //return $this->hasMany(Permission::class, 'role_id', 'id');
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
