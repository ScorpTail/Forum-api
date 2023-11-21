<?php

namespace App\Http\Controllers\V1\Token;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Token\CreateTokenRequest;
use App\Services\V1\TokenServices\PersonalAccessTokenService;

class PersonalAccessTokenController extends Controller
{
    public function __construct(private PersonalAccessTokenService $personalAccessTokenService)
    {}

    public function createToken(CreateTokenRequest $request)
    {
        $validation = $request->validated();

        $user = $this->personalAccessTokenService->checkUserExist($validation);

        $token = $user->createToken($validation->device_name)->plainTextToken;

        return response()->json(['message' => 'Success create access token', 'token' => $token], Response::HTTP_CREATED);
    }

    public function destroyToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete;

        return response()->json(['message' => 'Token destroyed'], Response::HTTP_OK);
    }
}
