<?php

namespace App\Http\Controllers\V1\ClientSide\Post;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSide\Post\PostCommentRequest;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Http\Resources\V1\ClientSide\Post\Comment\PostCommentResource;
use App\Services\V1\ClinetSideService\PostCommentClientService;

class PostCommentController extends Controller
{

    public function __construct(private PostCommentClientService $postCommentClientService)
    {
    }
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
        $this->postCommentClientService->storeCommnet($request, $post);

        return response()->json(['message' => 'Success'], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCommentRequest $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $this->postCommentClientService->updateComment($request, $comment);

        return response()->json(['message' => 'Success'], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $this->postCommentClientService->destroyComment($comment);

        return response()->noContent();
    }

    public function upvote(UpvoteRequest $request, Post $post, Comment $comment)
    {
        $this->postCommentClientService->upvoteForComment($request, $comment);

        return response()->noContent();
    }
}
