<?php

namespace App\Services\V1\AuthServices;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\V1\Contracts\AuthServiceInterface;


class AuthService implements AuthServiceInterface
{
    public function createTokenForUser($user): string
    {
        static::checkAuthUser($user);

        $token = Auth::user()->createToken('accesToken')->plainTextToken;

        return $token;
    }

    public function checkAuthUser(array $user)
    {
        if (!Auth::attempt($user)) {

            return response()->json(['message' => 'Failed authentication'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function createuser($registeredData): User
    {
        return User::create($registeredData);
    }
}
