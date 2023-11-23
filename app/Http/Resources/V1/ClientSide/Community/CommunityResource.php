<?php

namespace App\Http\Resources\V1\ClientSide\Community;

use App\Http\Resources\V1\ClientSide\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'community_id' => $this->id,
            'author_id' => $this->author->id,
            'name' => $this->name,
            'type' => $this->type,
            'disclaimer' => $this->disclaimer,
            'avatar_path' => $this->avatar_path,
            'banner_path' => $this->banner_path,
            'created_at' => $this->created_at,
        ];
    }
}
