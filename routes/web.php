<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\MypostController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminpostController;
use App\Http\Controllers\AdminuserController;

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

Route::get('/settings', function () {
    return view('profile_setting', [
        'title' => 'Blog | Setting',
        'profile' => auth()->user()
    ]);
})->name('settings');

Route::post('/signout', [SigninController::class, 'signout']);

// Route::get('/signout', [SigninController::class, 'signout']);

Route::get('/signup', [SignupController::class, 'index'])->middleware('guest');

Route::post('/signup', [SignupController::class, 'store']);

Route::resource('/post', PostController::class)->middleware('auth');


Route::resource('/savedpost', SavedController::class)->middleware('auth');

Route::resource('/profile', ProfileController::class)->middleware('auth');

Route::resource('/savedpost', SavedController::class)->middleware('auth');

Route::resource('/admin', AdminController::class)->middleware('auth', 'can:isAdmin', 'cannot:isUser');

Route::resource('/user_', AdminuserController::class)->middleware('auth', 'can:isAdmin', 'cannot:isUser');

Route::resource('/post_', AdminpostController::class)->middleware('auth', 'can:isAdmin', 'cannot:isUser');

Route::resource('/mypost', MypostController::class)->middleware('auth', 'can:isUser', 'cannot:isAdmin');
