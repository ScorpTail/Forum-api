<?php

namespace App\Http\Controllers\V1\ProviderSocialite;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\V1\ProviderSocialiteServices\ProviderSocialiteService;
use Illuminate\Support\Facades\Auth;

class ProviderSocialiteController extends Controller
{
    public function __construct(private ProviderSocialiteService $providerSocialiteService)
    {
    }

    public function redirectProvider(string $provider)
    {
        return $this->providerSocialiteService->getRedirectProvider($provider);
    }

    public function callbackProvider(string $provider)
    {
        $socialUser = $this->providerSocialiteService->getUserProviderDriver($provider);

        $user = $this->providerSocialiteService->createOrUpdateUser($provider, $socialUser);

        [$token, $refreshToken] = $this->providerSocialiteService->createTokenSocialite($user);

        return response()->json(['message' => 'Success', 'accessToken' => $token, 'refreshToken' => $refreshToken], Response::HTTP_OK);

        //dd($socialUser->getName(), $socialUser->getEmail(), $socialUser->getId(), $socialUser->getNickname(), $socialUser->getAvatar());
    }
}
