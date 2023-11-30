<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Community;
use App\Policies\V1\CommunityPolicy;
use App\Policies\V1\PostPolicy;
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
        Post::class => PostPolicy::class,
        Community::class => CommunityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
