<?php

namespace App\Services\V1\ClinetSideService;

use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ClientSideService
{
    public function storePost($request)
    {
        $validatedData = $request->validated();

        if ($request->has('image')) {
            $validatedData['image'] = '/storage/' . Storage::disk('public')->put('/post', $validatedData['image']);
        }
        dd(123);

        Post::create($validatedData);

        return response()->json(['message' => 'Created success', Response::HTTP_CREATED]);
    }
}
