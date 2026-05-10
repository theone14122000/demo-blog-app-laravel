<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

Route::get('/posts', [PostController::class, 'apiIndex']);

Route::get('/posts/{post}', [PostController::class, 'apiShow']);


/*
|--------------------------------------------------------------------------
| Protected API Routes
|TESTED ON POSTMAN--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {

        return $request->user();

    });

    Route::post('/posts', [PostController::class, 'apiStore']);

    Route::put('/posts/{post}', [PostController::class, 'apiUpdate']);

    Route::delete('/posts/{post}', [PostController::class, 'apiDestroy']);

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle']);

});


/*
|--------------------------------------------------------------------------
| Test Route
|--------------------------------------------------------------------------
*/

Route::get('/create-test', function () {

    \App\Models\Post::create([
        'title' => 'API Test',
        'content' => 'Created from API',
        'user_id' => 1,
    ]);

    return response()->json([
        'message' => 'Test post created successfully'
    ]);
});