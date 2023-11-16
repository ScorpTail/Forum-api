<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ClientSide\Post\PostController;
use App\Http\Controllers\V1\ClientSide\Post\PostCommentController;


Route::post('post/{post}/upvote', [PostController::class, 'upvote'])/*->middleware(['auth:sanctum'])**/->name('post.upvote');
Route::apiResource('post', PostController::class)->except(['store']);
Route::post('post', [PostController::class, 'store'])/*->middleware(['auth:sanctum'])**/->name('post.store');


Route::group([/*'middleware' => ['auth:sanctum']**/ ], function () {
    Route::post('post/{post}/comment/{comment}/upvote', [PostCommentController::class, 'upvote'])->name('post.comment.upvote');
    Route::apiResource('post.comment', PostCommentController::class)->except(['show']);
});
