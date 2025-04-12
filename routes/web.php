<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeetCodeEasyController;
use App\Http\Controllers\PHPController;

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

// Home
Route::group(['as' => 'home.', 'prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/draft', [HomeController::class, 'draft'])->name('draft');
});

// Relationships Model
Route::group(['as' => 'relationships.', 'prefix' => 'relationships'], function () {
    Route::get('/oneToOneExample', [HomeController::class, 'oneToOneExample'])->name('oneToOneExample');
    Route::get('/oneToMany', [HomeController::class, 'oneToMany'])->name('oneToMany');
    Route::get('/manyToMany', [HomeController::class, 'manyToMany'])->name('manyToMany');
    Route::get('/hasManyThrough', [HomeController::class, 'hasManyThrough'])->name('hasManyThrough');
    Route::get('/hasOneThrough', [HomeController::class, 'hasOneThrough'])->name('hasOneThrough');
});

// Redis
Route::group(['as' => 'redis.', 'prefix' => 'redis'], function () {
    Route::get('/', [HomeController::class, 'redis'])->name('redis');
    Route::get('/draft', [HomeController::class, 'draft'])->name('redis_draft');
});

// LeetCode
Route::group(['as' => 'leetcode.', 'prefix' => 'leetcode'], function () {
    Route::get('/', [LeetCodeEasyController::class, 'index'])->name('index');
    Route::get('/draft', [LeetCodeEasyController::class, 'draft'])->name('draft');
});

// PHP
Route::group(['as' => 'php.', 'prefix' => 'php'], function () {
    Route::get('/', [PHPController::class, 'index'])->name('index');
});
