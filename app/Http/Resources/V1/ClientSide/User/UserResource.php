<?php

namespace App\Http\Resources\V1\ClientSide\User;

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
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'baner' => $this->baner,
            'about' => $this->about,
            'created_at' => $this->created_at,

            'communties_count' => $this->subscribed->count(),
            'communties' => $this->subscribed,

            'posts_count' => $this->posts->count(),
            'post' => $this->posts,

            'comments_count' => $this->comments->count(),
            'comments' => $this->comments,

            'upvotes_count' => $this->upvotes->count(),
            'upvotes' => $this->upvotes,
        ];
    }
}
