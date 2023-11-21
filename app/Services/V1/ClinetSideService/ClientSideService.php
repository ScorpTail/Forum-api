<?php

namespace App\Services\V1\ClinetSideService;

use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ClientSideService
{
    public function storePost($request)
    {
        $validatedData = $this->validationData($request);
        $validatedData['user_id'] = $request->user()->id;

        return Post::create($validatedData);
    }
    public function updatePost($request, $post)
    {
        $validatedData = $this->validationData($request);

        return $post->update($validatedData);
    }

    private function validationData($request)
    {
        $validatedData = $request->validated();

        if ($request->has('image')) {
            $validatedData['image'] = $this->storeImage($request->file('image'));
        }

        return $validatedData;
    }

    private function storeImage($image)
    {

        return '/storage/' . $image->store('/post', 'public');
    }
}
