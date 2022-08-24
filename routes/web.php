<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\SavedController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\MypostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Post_Controller;



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

Route::prefix('guest')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('signin');

    Route::get('/signin', [AuthController::class, 'index']);

    Route::get('/signup', [AuthController::class, 'indexSignup']);

    Route::post('/signin', [AuthController::class, 'authenticate']);

    Route::post('/signup', [AuthController::class, 'store']);

    Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth');
});

Route::prefix('user')->middleware('auth', 'can:isUser')->group(function () {

    Route::resource('/post', PostController::class);

    Route::resource('/savedpost', SavedController::class);

    Route::resource('/profile', ProfileController::class);

    Route::resource('/savedpost', SavedController::class);

    Route::resource('/mypost', MypostController::class);
});

Route::prefix('admin')->middleware('auth', 'can:isAdmin')->group(function () {

    Route::resource('/', AdminController::class);

    Route::resource('/user', UserController::class);

    Route::resource('/post', Post_Controller::class);

    Route::resource('/category', CategoryController::class);

    Route::resource('/signup', AdminController::class);

    Route::post('/signin', [AuthController::class, 'authenticate']);

    Route::get('/signin', [AuthController::class, 'indexSignup']);

    Route::post('/signout', [AuthController::class, 'signout']);
});

// darurat
Route::get('/signout', [AuthController::class, 'signout']);

Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth');

Route::get('/about', function () {
    return view('about', [
        'title' => 'Blog | About',
    ]);
})->name('about')->prefix('user');

// sementara (to do: buat controller sendiri, middleware auth, isUser)
Route::get('/settings', function () {
    return view('user.profile_setting', [
        'title' => 'Blog | Setting',
        'profile' => auth()->user()
    ]);
})->name('settings')->prefix('user');
