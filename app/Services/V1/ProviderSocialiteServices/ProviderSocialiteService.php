<?php

namespace App\Services\V1\ProviderSocialiteServices;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Services\V1\Contracts\ProviderSocialiteServiceInterface;

class ProviderSocialiteService implements ProviderSocialiteServiceInterface
{
    public function getRedirectProvider(string $provider)
    {
        if ($provider === 'google') {
            return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        }

        return Socialite::driver($provider)->redirect()->getTargetUrl();
    }
    public function getUserProviderDriver(string $provider)
    {
        if ($provider === 'google') {
            Socialite::driver($provider)->stateless()->user();
        }

        return Socialite::driver($provider)->user();
    }

    public function createOrUpdateUser(string $provider, $socialUser): User
    {
        $user = User::updateOrCreate(
            [
                'email' => $socialUser->getEmail(),
            ],
            [
                'name' => $socialUser->getName(),
                'avatar' => $socialUser->getAvatar(),
            ]
        );

        $provider = [
            'nickName' => $socialUser->getNickname(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_token' => $socialUser->token,
            'provider_refresh_token' => $socialUser->refreshToken,
        ];

        $user->provider()->updateOrCreate($provider);

        return $user;
    }

    public function createTokenSocialite(User $user)
    {
        Auth::login($user);

        $user->tokens()->delete();

        $token = $user->createToken('accesToken')->plainTextToken;

        $refreshToken = $user->createToken('refreshToken')->plainTextToken;

        return [$token, $refreshToken];
    }
}
