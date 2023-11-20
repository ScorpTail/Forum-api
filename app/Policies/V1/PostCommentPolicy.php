<?php

namespace App\Policies\V1;

use App\Models\Comment;
use App\Models\User;

class PostCommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->author->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->author->id || $user->isAdmin();
    }

    public function upvote(User $user, Comment $comment)
    {
        return !$comment->upvotes->pluck('user_id')->contains($user->id);
    }
}
