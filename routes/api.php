<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/', function () {
//     return response()->json([
//         'message' => 'Hello World',
//         'status' => 'success'
//     ]);
// });

Route::middleware(['api.key'])->group(function () {
    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'getListUsers'])->name('getListUsers');
        Route::post('/', [UserController::class, 'createUser'])->name('createUser');
        Route::get('/{id}', [UserController::class, 'getUserById'])->name('getUserById');
        Route::put('/{id}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    });

    Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'getListPosts'])->name('getListPosts');
        Route::post('/', [PostController::class, 'createPost'])->name('createPost');
        Route::get('/{id}', [PostController::class, 'getPostById'])->name('getPostById');
        Route::put('/{id}', [PostController::class, 'updatePost'])->name('updatePost');
        Route::delete('/{id}', [PostController::class, 'deletePost'])->name('deletePost');
    });

    Route::group(['as' => 'test-exception.', 'prefix' => 'test-exception'], function () {
        Route::get('/{type}', [UserController::class, 'testExceptions'])->name('testExceptions');
    });

});

