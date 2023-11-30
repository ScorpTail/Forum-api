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
    {
    }

    public function createToken(CreateTokenRequest $request)
    {
        $validation = $request->validated();

        $user = $this->personalAccessTokenService->checkUserExist($validation);

        $token = $user->createToken($validation->device_name)->plainTextToken;

        return response()->json(['message' => 'Success create access token', 'token' => $token], Response::HTTP_CREATED);
    }

    public function destroyToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Token destroyed'], Response::HTTP_OK);
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();

        $refreshToken = explode("|", $request->input('refresh_token'))[1] ?? '';

        $token = optional($request->user()->tokens()->where('name', 'refreshToken')->first())->token;


        if (!hash_equals($token, hash('sha256', $refreshToken))) {
            return response()->json(['message' => 'Invalid resfresh token'], Response::HTTP_UNAUTHORIZED);
        }

        $user->tokens()->delete();

        $accessToken = $user->createToken('accesToken');
        $refreshToken = $user->createToken('refreshToken');

        return response()->json([
            'access_token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
        ]);
    }
}
