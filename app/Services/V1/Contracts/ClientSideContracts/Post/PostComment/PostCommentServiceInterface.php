<?php

namespace App\Services\V1\Contracts\ClientSideContracts\Post\PostComment;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Http\Requests\ClientSide\Post\PostCommentRequest;

interface PostCommentServiceInterface
{
    public function storeCommnet($request, Post $post);

    public function updateComment(PostCommentRequest $request, Comment $comment);

    public function destroyComment(Comment $comment);

    public function upvoteForComment(UpvoteRequest $request, Comment $comment);
}
