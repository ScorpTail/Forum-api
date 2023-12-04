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
    Route::post('/{post}/save', 'save')->name('save');
    Route::post('/{post}', 'update')->name('update');
    Route::post('/', 'store')->name('store');
});
Route::apiResource('post', PostController::class)->except(['store', 'update']);


Route::get('post/{post}/comment/', [PostCommentController::class, 'index'])->name('post.comment.index');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('post/{post}/comment/{comment}/upvote', [PostCommentController::class, 'upvote'])->name('post.comment.upvote');
    Route::apiResource('post.comment', PostCommentController::class)->except(['show', 'index']);
});


Route::group(['middleware' => ['auth:sanctum'], 'controller' => CommunityController::class], function () {
    Route::post('community/{community}/subscribe', 'subscribe')->name('community.subscribe');
    Route::post('community/{community}/unsubscribe', 'unsubscribe')->name('community.unsubscribe');
    Route::apiResource('community', CommunityController::class)->except(['index', 'show']);
});
Route::apiResource('community', CommunityController::class)->only(['index', 'show']);
