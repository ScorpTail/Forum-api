<?php

namespace App\Http\Controllers\V1\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\V1\AuthServices\AuthService;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function register(RegisterRequest $request)
    {
        $registeredData = $request->validated();

        User::create($registeredData);

        $token = $this->authService->createTokenForUser($registeredData);

        return response()->json(['message' => 'Success registration', 'token' => $token], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $token = $this->authService->createTokenForUser($data);

        return response()->json(['message' => 'Success authentication', 'token' => $token], Response::HTTP_OK);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->noContent();
    }
}
