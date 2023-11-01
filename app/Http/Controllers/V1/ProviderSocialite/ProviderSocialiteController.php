<?php

namespace App\Http\Controllers\V1\ProviderSocialite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class ProviderSocialiteController extends Controller
{
    public function redirectProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callbackProvider(string $provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        dd($user->getName(), $user->getEmail(), $user->getId(), $user->getNickname(), $user->getAvatar());
    }
}
