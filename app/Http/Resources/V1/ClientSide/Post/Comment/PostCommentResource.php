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
            'user_name' => $this->author->name,
            'user_avatar' => $this->author->avatar,
            'comment' => $this->comment,
            'created_at' => $this->created_at,

            'comment_upvotes_count' => $this->upvotes->where('upvote', 1)->count() - $this->upvotes->where('upvote', 0)->count(),
        ];
    }
}
