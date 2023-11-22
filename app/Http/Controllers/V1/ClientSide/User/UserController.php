<?php

namespace App\Http\Controllers\V1\ClientSide\User;

use App\Http\Resources\V1\ClientSide\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(Request $request, ?User $user = null)
    {
        if (!is_null($user)) {
            return new UserResource($user);
        }

        return new UserResource($request->user());
    }

    public function update(Request $request, User $user)
    {
        //
    }
}
