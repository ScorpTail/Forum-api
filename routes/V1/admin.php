<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Admin\Post\PostController;
use App\Http\Controllers\V1\Admin\Role\RoleController;
use App\Http\Controllers\V1\Admin\User\UserController;
use App\Http\Controllers\V1\Admin\Category\CategoryController;
use App\Http\Controllers\V1\Admin\BannedUser\BannedUserController;
use App\Http\Controllers\V1\Admin\Community\CommunityController;
use App\Http\Controllers\V1\Admin\Permission\PermissionController;

Route::apiResource('banned', BannedUserController::class);

Route::apiResource('category', CategoryController::class);

Route::apiResource('community', CommunityController::class);

Route::apiResource('permission', PermissionController::class);

Route::apiResource('post', PostController::class);

Route::apiResource('role', RoleController::class);

Route::apiResource('user', UserController::class)->except(['store', 'update']);
