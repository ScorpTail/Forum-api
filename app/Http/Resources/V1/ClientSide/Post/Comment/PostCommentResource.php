<?php

namespace App\Http\Resources\V1\ClientSide\Post\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'comment' => $this->comment,

            'comment_upvotes' => $this->upvotes->where('upvote', 1)->count(),
            'comment_downvotes' => $this->upvotes->where('upvote', 0)->count(),
        ];
    }
}
