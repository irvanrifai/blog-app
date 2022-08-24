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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminpostController;
use App\Http\Controllers\AdminuserController;
use App\Http\Controllers\AuthController;

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

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('signin')->middleware('guest');

    Route::get('/signin', [AuthController::class, 'index'])->middleware('guest');

    Route::get('/signup', [AuthController::class, 'indexSignup'])->middleware('guest');
});

// untuk signin/signup admin juga pakai. jadi tidak menggunakan middleware
Route::post('/signin', [AuthController::class, 'authenticate']);
Route::post('/signup', [AuthController::class, 'store']);

Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth');

// darurat
// Route::get('/signout', [SigninController::class, 'signout']);

Route::get('/about', function () {
    return view('about', [
        'title' => 'Blog | About',
    ]);
})->name('about');

// sementara (to do: buat controller sendiri, middleware auth, isUser)
Route::get('/settings', function () {
    return view('profile_setting', [
        'title' => 'Blog | Setting',
        'profile' => auth()->user()
    ]);
})->name('settings');

Route::prefix('user')->middleware('auth', 'isUser')->group(function () {

    Route::resource('/post', PostController::class)->middleware('auth', 'can:isUser', 'cannot:isAdmin');

    Route::resource('/savedpost', SavedController::class)->middleware('auth', 'can:isUser', 'cannot:isAdmin');

    Route::resource('/profile', ProfileController::class)->middleware('auth', 'can:isUser', 'cannot:isAdmin');

    Route::resource('/savedpost', SavedController::class)->middleware('auth', 'can:isUser', 'cannot:isAdmin');

    Route::resource('/mypost', MypostController::class)->middleware('auth', 'can:isUser', 'cannot:isAdmin');
});

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {

    Route::resource('/admin', AdminController::class);

    Route::resource('/user_', AdminuserController::class);

    Route::resource('/post_', AdminpostController::class);

    Route::resource('/category_', CategoryController::class);

    Route::resource('/signup_', AdminController::class);
});
