<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'apiIndex']);
Route::get('/posts/{post}', [PostController::class, 'apiShow']);
Route::post('/posts', [PostController::class, 'apiStore']);
Route::post('/posts/{post}/like', [LikeController::class, 'toggle']);

Route::get('/create-test', function () {

    \App\Models\Post::create([
        'title' => 'API Test',
        'content' => 'Created from API',
        'user_id' => 1,
    ]);

    return 'Created';
});