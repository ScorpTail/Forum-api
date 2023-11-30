<?php

namespace App\Http\Controllers\V1\ClientSide\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Requests\ClientSide\Post\PostRequest;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Http\Resources\V1\ClientSide\Post\PostResource;
use App\Services\V1\ClinetSideService\PostClientSideService;

class PostController extends Controller
{
    public function __construct(private PostClientSideService $postClientSideService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postClientSideService->sorting($request);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->authorize('store', Post::class);

        $this->postClientSideService->storePost($request);

        return response()->json(['message' => 'Created success'], Response::HTTP_CREATED);
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
        $this->authorize('update', $post);

        $this->postClientSideService->updatePost($request, $post);

        return response()->json(['message' => 'Update success'], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);

        $this->postClientSideService->destroyPost($post);

        return response()->noContent();
    }

    public function upvote(UpvoteRequest $request, Post $post)
    {
        $this->authorize('upvote', $post);

        $this->postClientSideService->upvotePost($request, $post);

        return response()->noContent();
    }
}
