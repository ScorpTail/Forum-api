<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ClientSide\Post\PostController;
use App\Http\Controllers\V1\ClientSide\Post\PostCommentController;
use App\Http\Controllers\V1\ClientSide\Community\CommunityController;

Route::post('post/{post}/upvote', [PostController::class, 'upvote'])->middleware(['auth:sanctum'])->name('post.upvote');
Route::post('post', [PostController::class, 'store'])->middleware(['auth:sanctum'])->name('post.store');
Route::post('post/{post}', [PostController::class, 'update'])->middleware(['auth:sanctum'])->name('post.update');
Route::apiResource('post', PostController::class)->except(['store', 'update']);


Route::get('post/{post}/comment/', [PostCommentController::class, 'index'])->name('post.comment.index');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('post/{post}/comment/{comment}/upvote', [PostCommentController::class, 'upvote'])->name('post.comment.upvote');
    Route::apiResource('post.comment', PostCommentController::class)->except(['show', 'index']);
});


Route::apiResource('community', CommunityController::class);
