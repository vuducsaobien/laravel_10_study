<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeetCodeEasyController;
use App\Http\Controllers\PHPController;
// use App\Http\Controllers\LiMixController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Limix
Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'getListUsers'])->name('getListUsers');
    Route::post('/', [UserController::class, 'createUser'])->name('createUser');
    Route::get('/{id}', [UserController::class, 'getUserById'])->name('getUserById');
    Route::put('/{id}', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
});

Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
    Route::get('/', [LiMixController::class, 'getListPosts'])->name('getListPosts');
    Route::post('/', [LiMixController::class, 'createPost'])->name('createPost');
    Route::get('/{id}', [LiMixController::class, 'getPostById'])->name('getPostById');
    Route::put('/{id}', [LiMixController::class, 'updatePost'])->name('updatePost');
    Route::delete('/{id}', [LiMixController::class, 'deletePost'])->name('deletePost');
});