<?php

use Canvas\Http\Controllers\PostController;
use Canvas\Http\Controllers\SearchController;
use Canvas\Http\Controllers\StatsController;
use Canvas\Http\Controllers\TagController;
use Canvas\Http\Controllers\TopicController;
use Canvas\Http\Controllers\UploadsController;
use Canvas\Http\Controllers\UserController;
use Canvas\Http\Controllers\ViewController;
use Canvas\Http\Middleware\Admin;
use Canvas\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware([Authenticate::class])->group(function () {
    Route::prefix('api')->group(function () {
        // Stats routes...
        Route::get('stats', [StatsController::class, 'index']);

        // Upload routes...
        Route::prefix('uploads')->group(function () {
            Route::post('/', [UploadsController::class, 'store']);
            Route::delete('/', [UploadsController::class, 'destroy']);
        });

        // Post routes...
        Route::prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::get('create', [PostController::class, 'create']);
            Route::get('{id}', [PostController::class, 'show']);
            Route::get('{id}/stats', [PostController::class, 'stats']);
            Route::post('{id}', [PostController::class, 'store']);
            Route::delete('{id}', [PostController::class, 'destroy']);
        });

        // Tag routes...
        Route::prefix('tags')->middleware([Admin::class])->group(function () {
            Route::get('/', [TagController::class, 'index']);
            Route::get('create', [TagController::class, 'create']);
            Route::get('{id}', [TagController::class, 'show']);
            Route::get('{id}/posts', [TagController::class, 'posts']);
            Route::post('{id}', [TagController::class, 'store']);
            Route::delete('{id}', [TagController::class, 'destroy']);
        });

        // Topic routes...
        Route::prefix('topics')->middleware([Admin::class])->group(function () {
            Route::get('/', [TopicController::class, 'index']);
            Route::get('create', [TopicController::class, 'create']);
            Route::get('{id}', [TopicController::class, 'show']);
            Route::get('{id}/posts', [TopicController::class, 'posts']);
            Route::post('{id}', [TopicController::class, 'store']);
            Route::delete('{id}', [TopicController::class, 'destroy']);
        });

        // User routes...
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->middleware([Admin::class]);
            Route::get('create', [UserController::class, 'create'])->middleware([Admin::class]);
            Route::get('{id}', [UserController::class, 'show']);
            Route::get('{id}/posts', [UserController::class, 'posts']);
            Route::post('{id}', [UserController::class, 'store']);
            Route::delete('{id}', [UserController::class, 'destroy'])->middleware([Admin::class]);
        });

        // Search routes...
        Route::prefix('search')->group(function () {
            Route::get('posts', [SearchController::class, 'posts']);
            Route::get('tags', [SearchController::class, 'tags'])->middleware([Admin::class]);
            Route::get('topics', [SearchController::class, 'topics'])->middleware([Admin::class]);
            Route::get('users', [SearchController::class, 'users'])->middleware([Admin::class]);
        });
    });

    // Catch-all route...
    Route::get('/{view?}', [ViewController::class, 'index'])->where('view', '(.*)')->name('canvas');
});
