<?php

namespace App\Http\Controllers\V1\ProviderSocialite;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;

class ProviderSocialiteController extends Controller
{
    public function redirectProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callbackProvider(string $provider)
    {
        if ($provider == 'google') {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } else {
            $socialUser = Socialite::driver($provider)->user();
        }

        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider' => $provider,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token,
        ]);

        return response(['message' => 'Success', 'userToken' => $user->token], Response::HTTP_OK);

        //dd($user->getName(), $user->getEmail(), $user->getId(), $user->getNickname(), $user->getAvatar());
    }
}
