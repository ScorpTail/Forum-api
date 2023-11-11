<?php

namespace App\Http\Resources\V1\Admin\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V1\Admin\Permission\PermissionCollection;
use App\Http\Resources\V1\Admin\Permission\PermissionResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'permissions' => PermissionResource::collection($this->permissions)
        ];
    }
}
