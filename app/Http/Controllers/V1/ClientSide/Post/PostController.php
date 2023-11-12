<?php

namespace App\Http\Controllers\V1\ClientSide\Post;

use App\Models\Post;
use App\Services\V1\ClinetSideService\ClientSideService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClientSide\Post\PostRequest;
use App\Http\Resources\V1\ClientSide\Post\PostResource;
use App\Http\Resources\V1\ClientSide\Post\PostCollection;

class PostController extends Controller
{
    public function __construct(private ClientSideService $clientSideService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PostCollection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        return $this->clientSideService->storePost($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $validatedData = $request->validated();

        if ($request->has('image')) {
            $validatedData['image'] = '/storage/' . Storage::disk('public')->put('/post', $validatedData['image']);
        }

        $post->update($validatedData);

        return response()->json(['message' => 'Update success', Response::HTTP_CREATED]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
