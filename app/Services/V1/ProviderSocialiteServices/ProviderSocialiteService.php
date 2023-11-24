<?php

namespace App\Services\V1\ProviderSocialiteServices;

use App\Models\User;
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
        return User::updateOrCreate(
            [
                'provider_id' => $socialUser->id,
                'provider' => $provider,
            ],
            [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_token' => $socialUser->token,
            ]
        );
    }
}
