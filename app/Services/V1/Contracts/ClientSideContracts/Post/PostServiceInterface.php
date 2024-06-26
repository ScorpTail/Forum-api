<?php

namespace App\Services\V1\Contracts\ClientSideContracts\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;

interface PostServiceInterface
{
    public function storePost($request);

    public function updatePost($request, Post $post);

    public function destroyPost(Post $post);

    public function upvote(UpvoteRequest $request, Model $post);
}
