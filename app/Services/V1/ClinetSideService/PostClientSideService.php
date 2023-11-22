<?php

namespace App\Services\V1\ClinetSideService;

use App\Models\Post;

class PostClientSideService
{

    private function __construct(private ClientSideService $clientSideService)
    {
    }
    public function storePost($request)
    {
        $validatedData = $this->clientSideService->validationData($request);

        $validatedData['user_id'] = $request->user()->id;

        return Post::create($validatedData);
    }
    public function updatePost($request, $post)
    {
        $validatedData = $this->clientSideService->validationData($request);

        return $post->update($validatedData);
    }
}
