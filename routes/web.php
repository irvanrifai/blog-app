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

Route::get('/', [PostController::class, 'index'])->middleware('guest');
// Route::get('/', function(){
//     return response("service up", 200);
// });
Route::get('/signin', [AuthController::class, 'index'])->name('signin')->middleware('guest');
Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth');
Route::get('/about', [PostController::class, 'about']);

Route::prefix('guest')->middleware('guest')->group(function () {
    // Route::get('/', [AuthController::class, 'index'])->name('signin');

    Route::get('/signin', [AuthController::class, 'index']);

    Route::get('/signup', [AuthController::class, 'create']);

    Route::post('/signin', [AuthController::class, 'authenticate']);

    Route::post('/signup', [AuthController::class, 'store']);

    Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth');
});

Route::prefix('user')->middleware('auth', 'can:isUser')->group(function () {

    Route::resource('/post', PostController::class);

    Route::resource('/savedpost', SavedController::class);

    Route::resource('/profile', ProfileController::class);

    Route::get('/setting', [ProfileController::class, 'setting']);

    Route::resource('/category', CategoryController::class)->only('show');

    Route::resource('/savedpost', SavedController::class);

    Route::resource('/mypost', MypostController::class);
});

Route::prefix('admin')->middleware('auth', 'can:isAdmin')->group(function () {

    Route::resource('/', AdminController::class);

    Route::resource('/user', UserController::class);

    Route::resource('/post', Post_Controller::class);

    Route::resource('/category', CategoryController::class);

    Route::resource('/signup', AdminController::class);

    Route::get('/signin', [AdminController::class, 'indexSignin']);

    Route::post('/signin', [AdminController::class, 'authenticate']);

    Route::post('/signout', [AuthController::class, 'signout']);
});

// darurat
Route::get('/signout', [AuthController::class, 'signout']);
