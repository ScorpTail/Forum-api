<?php

namespace App\Http\Controllers\V1\ClientSide\Post;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSide\Post\PostCommentRequest;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Http\Resources\V1\ClientSide\Post\Comment\PostCommentCollection;
use App\Http\Resources\V1\ClientSide\Post\Comment\PostCommentResource;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        return PostCommentResource::collection($post->comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCommentRequest $request, Post $post)
    {
        $validated = $request->validated();

        $validated['user_id'] = $request->user()->id ?? 1;

        $post->comments()->create($validated);

        return response()->json(['message' => 'Success'], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCommentRequest $request, Post $post, Comment $comment)
    {
        //$this->authorize('update', $comment);

        $validated = $request->validated();

        $comment->update($validated);

        return response()->json(['message' => 'Success'], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        //$this->authorize('delete', $comment);

        $comment->delete();

        return response()->noContent();
    }

    public function upvote(UpvoteRequest $request, Post $post, Comment $comment)
    {
        $upvote = $request->validated();

        $upvote['user_id'] = $request->user()->id ?? 1;

        $comment->upvotes()->create($upvote);

        return response()->noContent();
    }
}
