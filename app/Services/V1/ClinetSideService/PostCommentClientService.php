<?php

namespace App\Services\V1\ClinetSideService;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Http\Requests\ClientSide\Post\PostCommentRequest;
use App\Services\V1\Contracts\ClientSideContracts\Post\PostComment\PostCommentServiceInterface;

class PostCommentClientService implements PostCommentServiceInterface
{
    public function storeCommnet($request, Post $post)
    {
        $validated = $request->validated();

        $post->comments()->create($validated);
    }

    public function updateComment(PostCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();

        $comment->update($validated);
    }

    public function destroyComment(Comment $comment)
    {
        $comment->upvotes()->delete();

        $comment->delete();
    }

    public function upvoteForComment(UpvoteRequest $request, Comment $comment)
    {
        $upvote = $request->validated();

        $comment->upvotes()->create($upvote);
    }
}
