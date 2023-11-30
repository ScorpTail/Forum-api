<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\V1\AuthServices\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function register(RegisterRequest $request)
    {
        $registeredData = $request->validated();

        $this->authService->createuser($registeredData);

        [$token, $refreshToken] = $this->authService->createTokenForUser($registeredData);

        return response()->json(
            [
                'message' => 'Success registration',
                'token' => $token, 'refreshToken' => $refreshToken,
            ],
            Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        [$token, $refreshToken] = $this->authService->createTokenForUser($data);

        return response()->json(
            [
                'message' => 'Success registration',
                'token' => $token, 'refreshToken' => $refreshToken,
            ],
            Response::HTTP_OK
        );
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->name == 'refreshToken') {
            return response()->json(['message' => 'Unauthorized.'], Response::HTTP_UNAUTHORIZED);
        }
        auth()->user()->tokens()->delete();

        return response()->noContent();
    }
}
