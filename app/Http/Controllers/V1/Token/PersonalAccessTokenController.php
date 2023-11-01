<?php

namespace App\Http\Controllers\V1\Token;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Token\CreateTokenRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\If_;

class PersonalAccessTokenController extends Controller
{
    public function createToken(CreateTokenRequest $request)
    {
        $validation = $request->validated();

        $user = User::where('email', $validation->email)->first();

        if (!$user || !Hash::check($validation->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($validation->device_name)->plainTextToken;

        return response([
            'message' => 'Success create access token',
            'token' => $token
        ], Response::HTTP_CREATED);
    }

    public function destroyToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete;

        return response(['message' => 'Token destroyed'], Response::HTTP_OK);
    }
}
