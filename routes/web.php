<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MypostController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SavedpostController;

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

Route::get('/about', function () {
    return view('about', [
        'title' => 'Blog | About',
    ]);
})->name('about');

Route::get('/profile', function () {
    return view('manipulate_profile', [
        'title' => 'Blog | Profile',
    ]);
})->name('profile');

Route::get('/settings', function () {
    return view('profile_setting', [
        'title' => 'Blog | Setting',
    ]);
})->name('settings');

// nyoba
Route::get('/create', function () {
    return view('add_post', [
        'title' => 'Blog | New Post',
    ]);
})->name('newpost');
Route::get('/edit', function () {
    return view('manipulate_post', [
        'title' => 'Blog | Edit Post',
    ]);
})->name('editpost');

Route::post('/signout', [SigninController::class, 'signout']);

Route::get('/signup', [SignupController::class, 'index'])->middleware('guest');

Route::post('/signup', [SignupController::class, 'store']);

Route::resource('/post', PostController::class)->middleware('auth');

// Route::resource('/mypost', MypostController::class)->middleware('isAdmin');
Route::resource('/mypost', MypostController::class)->middleware('auth');

// Route::get('/mypost/create', [MypostController::class, 'store']);

Route::resource('/savedpost', SavedpostController::class)->middleware('auth');
