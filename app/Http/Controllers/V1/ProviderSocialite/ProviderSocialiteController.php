<?php

namespace App\Http\Controllers\V1\ProviderSocialite;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\V1\ProviderSocialiteServices\ProviderSocialiteService;

class ProviderSocialiteController extends Controller
{
    public function __construct(private ProviderSocialiteService $providerSocialiteService)
    {}

    public function redirectProvider(string $provider)
    {
        return $this->providerSocialiteService->getRedirectProvider($provider);
    }

    public function callbackProvider(string $provider)
    {
        $socialUser = $this->providerSocialiteService->getUserProviderDriver($provider);

        $user = $this->providerSocialiteService->createOrUpdateUser($provider, $socialUser);

        return response()->json(['message' => 'Success', 'userToken' => $user->token], Response::HTTP_OK);

        //dd($user->getName(), $user->getEmail(), $user->getId(), $user->getNickname(), $user->getAvatar());
    }
}
