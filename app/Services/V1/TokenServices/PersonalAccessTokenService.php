<?php

namespace App\Services\V1\TokenServices;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\V1\Contracts\PersonalAccessTokenServiceInterface;

class PersonalAccessTokenService implements PersonalAccessTokenServiceInterface
{
    public function checkUserExist($validationData): User
    {
        $user = User::where('email', $validationData->email)->first();

        if (!$user || !Hash::check($validationData->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.'],]);
        }

        return $user;
    }
}
