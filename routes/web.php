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
// Route::get('/', [UserController::class, 'home'])->name('home');

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

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});