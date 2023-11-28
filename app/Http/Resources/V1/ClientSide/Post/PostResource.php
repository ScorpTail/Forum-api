<?php

namespace App\Http\Resources\V1\ClientSide\Post;

use App\Http\Resources\V1\ClientSide\Community\CommunityResource;
use App\Http\Resources\V1\ClientSide\Post\Comment\PostCommentResource;
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
            'post_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at,

            'comments' => PostCommentResource::collection($this->comments),

            'user_info' => [
                'user_id' => $this->author->id,
                'user_name' => $this->author->name,
            ],
            'post_info' => [
                'post_upvotes_count' => $this->upvotes->where('upvote', 1)->count() - $this->upvotes->where('upvote', 0)->count(),
                'post_comments_count' => $this->comments->count(),
            ],
            'community_info' => new CommunityResource($this->community),
        ];
    }
}
