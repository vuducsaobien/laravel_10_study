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
Route::get('/', [HomeController::class, 'home'])->name('home');

// Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
//     Route::get('/', [UserController::class, 'getListUsers'])->name('getListUsers');
//     Route::post('/', [UserController::class, 'createUser'])->name('createUser');
//     Route::get('/{id}', [UserController::class, 'getUserById'])->name('getUserById');
//     Route::put('/{id}', [UserController::class, 'updateUser'])->name('updateUser');
//     Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
// });

// Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
//     Route::get('/', [PostController::class, 'getListPosts'])->name('getListPosts');
//     Route::post('/', [PostController::class, 'createPost'])->name('createPost');
//     Route::get('/{id}', [PostController::class, 'getPostById'])->name('getPostById');
//     Route::put('/{id}', [PostController::class, 'updatePost'])->name('updatePost');
//     Route::delete('/{id}', [PostController::class, 'deletePost'])->name('deletePost');
// });