<?php

namespace App\Policies\V1;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function store(): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->author->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->author->id || $user->isAdmin();
    }

    public function upvote(User $user, Post $post): bool
    {
        return !$post->upvotes->pluck('user_id')->contains($user->id);
    }
}
