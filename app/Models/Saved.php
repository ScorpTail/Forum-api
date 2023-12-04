<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saved extends Model
{
    use HasFactory;

    protected $table = 'saveds';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
