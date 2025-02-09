<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home_index');
Route::get('/oneToOneExample', [HomeController::class, 'oneToOneExample'])->name('oneToOneExample');
Route::get('/oneToMany', [HomeController::class, 'oneToMany'])->name('oneToMany');
Route::get('/manyToMany', [HomeController::class, 'manyToMany'])->name('manyToMany');
Route::get('/hasManyThrough', [HomeController::class, 'hasManyThrough'])->name('hasManyThrough');


