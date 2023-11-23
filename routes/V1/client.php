<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ClientSide\Post\PostController;
use App\Http\Controllers\V1\ClientSide\Post\PostCommentController;
use App\Http\Controllers\V1\ClientSide\Community\CommunityController;

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'post', 'as' => 'post.',
    'controller' => PostController::class
], function () {
    Route::post('/{post}/upvote', 'upvote')->name('upvote');
    Route::post('/{post}', 'update')->name('update');
    Route::post('/', 'store')->name('store');
});
Route::apiResource('post', PostController::class)->except(['store', 'update']);


Route::get('post/{post}/comment/', [PostCommentController::class, 'index'])->name('post.comment.index');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('post/{post}/comment/{comment}/upvote', [PostCommentController::class, 'upvote'])->name('post.comment.upvote');
    Route::apiResource('post.comment', PostCommentController::class)->except(['show', 'index']);
});



Route::apiResource('community', CommunityController::class)->middleware(['auth:sanctum'])->except(['index', 'show']);
Route::apiResource('community', CommunityController::class)->only(['index', 'show']);
