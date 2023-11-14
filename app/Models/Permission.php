<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'type',
    ];

    public function role(): BelongsToMany
    {
        //return $this->belongsTo(Role::class, 'id', 'role_id');
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
