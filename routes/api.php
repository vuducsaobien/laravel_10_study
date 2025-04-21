<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;

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
        Route::delete('/validate', [TestController::class, 'testValidateException'])->name('testValidateException');
        Route::get('/database', [TestController::class, 'testDatabaseException'])->name('testDatabaseException');
        Route::get('/bussiness', [TestController::class, 'testBussinessException'])->name('testBussinessException');
        Route::get('/system', [TestController::class, 'testSystemException'])->name('testSystemException');
    });

});

