<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\ClientSide\User\UserController;
use App\Http\Controllers\V1\ImageController;
use App\Http\Controllers\V1\Token\PersonalAccessTokenController;
use App\Http\Controllers\V1\ProviderSocialite\ProviderSocialiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|s
*/

Route::get('/getImage/{fileName}', ImageController::class);

Route::group(['as.' => 'user.', 'prefix' => 'user/id/', 'controller' => UserController::class], function () {
    Route::get('{user}', 'showUserProfile')->name('showProfile');

    Route::get('/', 'showCurrentUser')->name('showCurrentUser')->middleware('auth:sanctum');

    Route::post('{user}', 'updateUserProfile')->name('updateProfile')->middleware('auth:sanctum');
});


Route::group(['as' => 'auth.', 'controller' => AuthController::class], function () {

    Route::post('/register', 'register')->middleware('guest:sanctum')->name('register');

    Route::post('/login', 'login')->middleware('guest:sanctum')->name('login');

    Route::post('/logout', 'logout')->middleware(['auth:sanctum'])->name('logout');
});

Route::group([
    'middleware' => ['guest:sanctum'],
    'prefix' => '/auth/{provider}',
    'as' => 'socialite.',
    'controller' => ProviderSocialiteController::class,
], function () {

    Route::get('/', 'redirectProvider')->name('redirect');

    Route::get('/callback', 'callbackProvider')->name('callback');
});

Route::group(['prefix' => 'personal-access-token', 'as' => 'token.', 'controller' => PersonalAccessTokenController::class], function () {

    Route::post('/', 'createToken')->name('createToken');

    Route::post('/refresh', 'refreshToken')->name('refreshToken')->middleware(['auth:sanctum']);

    Route::delete('/destroy', 'destroyToken')->name('destroyToken')->middleware('auth:sanctum');
});
