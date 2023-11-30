<?php

namespace App\Http\Resources\V1\ClientSide\User;

use App\Http\Resources\V1\ClientSide\Community\CommunityResource;
use App\Http\Resources\V1\ClientSide\Post\Comment\PostCommentResource;
use App\Http\Resources\V1\ClientSide\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'baner' => $this->baner,
            'about' => $this->about,
            'created_at' => $this->created_at,

            'communties_count' => $this->subscribed->count(),
            'communties' => CommunityResource::collection($this->subscribed),

            'posts_count' => $this->posts->count(),
            'post' => PostResource::collection($this->posts),

            'comments_count' => $this->comments->count(),
            'comments' => PostCommentResource::collection($this->comments),

            'upvotes_count' => $this->upvotes->count(),
            'upvotes' => $this->upvotes,
        ];
    }
}
