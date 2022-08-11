<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [SigninController::class, 'index'])->name('signin')->middleware('guest');

Route::post('/signin', [SigninController::class, 'authenticate']);

Route::get('/signin', [SigninController::class, 'index']);

Route::post('/signout', [SigninController::class, 'signout']);

Route::get('/signup', [SignupController::class, 'index'])->middleware('guest');

Route::post('/signup', [SignupController::class, 'store']);

Route::resource('/PostController', PostController::class)->middleware('auth');
