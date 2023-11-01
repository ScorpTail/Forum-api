<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return ["sanya" => "lox->GitHub Actions"];
});

Route::get('/auth/{provider}', function ($provider) {
    return Socialite::driver($provider)->stateless()->redirect();
});
Route::get('/auth/{provider}/callback', function ($provider) {
    $user = Socialite::driver($provider)->stateless()->user();

    dd($user->getName(), $user->getEmail(), $user->getId(), $user->getNickname(), $user->getAvatar());
});
