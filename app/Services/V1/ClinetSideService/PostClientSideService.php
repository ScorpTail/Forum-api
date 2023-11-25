<?php

namespace App\Services\V1\ClinetSideService;

use App\Models\Post;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Services\V1\Contracts\ClientSideContracts\Post\PostServiceInterface;

class PostClientSideService implements PostServiceInterface
{

    public function __construct(private ClientSideService $clientSideService)
    {
    }

    public function storePost($request)
    {
        $validatedData = $this->clientSideService->validationData($request);

        //$validatedData['user_id'] = $request->user()->id;

        return Post::create($validatedData);
    }
    public function updatePost($request, $post)
    {
        $validatedData = $this->clientSideService->validationData($request);

        return $post->update($validatedData);
    }

    public function destroyPost(Post $post)
    {
        $post->comments()->delete();

        $post->upvotes()->delete();

        $post->delete();

        return true;
    }

    public function upvotePost(UpvoteRequest $request, Post $post)
    {
        $upvote = $request->validated();

        $post->upvotes()->create($upvote);

        return true;
    }
}
