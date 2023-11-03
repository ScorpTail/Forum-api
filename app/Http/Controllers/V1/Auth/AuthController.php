<?php

namespace App\Http\Controllers\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $registered = $request->validated();

        $user = User::create($registered);

        return response(['message' => 'Success registration', 'user' => $user], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $user = $request->validated();

        if (!Auth::attempt($user)) {
            return response(['message' => 'Failed authentication'], Response::HTTP_UNAUTHORIZED);
        }

        $user['token'] = Auth::user()->createToken('accesToken')->plainTextToken;

        return response(['message' => 'Success authentication', 'user' => $user], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        if (!Auth::user()) {
            return response(['message' => 'Unauthentication', Response::HTTP_UNAUTHORIZED]);
        }

        Auth::logout();

        $request->user()->tokens()->delete();

        return response()->noConte();
    }
}
