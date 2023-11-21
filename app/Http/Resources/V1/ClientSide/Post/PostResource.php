<?php

namespace App\Http\Resources\V1\ClientSide\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at,

            'post_upvotes' => $this->upvotes->where('upvote', 1)->count(),
            'post_downvotes' => $this->upvotes->where('upvote', 0)->count(),

            'post_comments' => $this->comments->count(),
        ];
    }
}
