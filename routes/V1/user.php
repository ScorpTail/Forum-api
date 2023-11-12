<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ClientSide\Post\PostController;


Route::apiResource('post', PostController::class)
    ->except(['store']);

Route::group([/*'middleware' => 'auth:sanctum',**/ 'as' => 'post.', 'controller' => PostController::class], function () {
    Route::post('post', 'store')->name('store');
});
