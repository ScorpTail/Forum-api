<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\Post\PostController;

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('post', PostController::class);
});
