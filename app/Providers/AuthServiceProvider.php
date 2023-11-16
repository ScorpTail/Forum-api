<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\V1\ClientSide\Post\PostCommentController;
use App\Models\Comment;
use App\Policies\V1\PostCommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comment::class => PostCommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
