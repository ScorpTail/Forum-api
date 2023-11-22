<?php

namespace App\Http\Controllers\V1\ClientSide\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSide\User\UserRequest;
use App\Http\Resources\V1\ClientSide\User\UserResource;
use App\Services\V1\ClinetSideService\ClientSideService;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function __construct(private ClientSideService $clientSideService)
    {
    }

    public function show(Request $request, ?User $user = null)
    {
        return new UserResource($user ?? $request->user());
    }

    public function update(UserRequest $request)
    {
        $validated = $this->clientSideService->validationData($request);

        $request->user()->update($validated);

        return response()->noContent(Response::HTTP_ACCEPTED);
    }
}
