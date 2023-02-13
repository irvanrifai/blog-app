<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// health
Route::get('/', function(){
    return response("service up and ready", 200);
});

// POST
// get all post
Route::get('/get-posts',function(){
    $data = Post::latest()->get();
    return $data;
});
// get one post
Route::get('/get-one-post/{id}',function($id){
    $data = Post::latest()->where('id', $id)->get();
    return $data;
});
// add post
Route::post('add-post', function(Request $request){
    $validatedData = Validator::make($request->all(), [
        'cover' => 'image|file|max:2048',
        'title' => 'required|max:100',
        'category' => 'required',
        'body' => 'required',
        'user' => 'required',
    ]);

    if ($validatedData->fails()) {
        return response($validatedData->errors());
    } else {
        $validatedData = $request->validate([
            'cover' => 'image|file|max:2048',
            'title' => 'required|max:100',
            'category' => 'required',
            'body' => 'required',
            'user' => 'required',
        ]);
        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('post-cover');
        }
        $validatedData['user_id'] = User::where('name', "LIKE", "%" . $request->user . "%")->first()->id;
        $validatedData['category_id'] = Category::where('name', "LIKE", "%". $request->category . "%")->first()->id;
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);
        Post::create($validatedData);
        return response("data inserted");
    }
});
// update post
Route::put('update-post/{slug}', function(Request $request, $slug){
    $validatedData = Validator::make($request->all(), [
        'cover' => 'image|file|max:2048',
        'title' => 'required|max:100',
        'category' => 'required',
        'body' => 'required',
        'user' => 'required',
    ]);

    if ($validatedData->fails()) {
        return response($validatedData->errors());
    } else {
        $validatedData = $request->validate([
            'cover' => 'image|file|max:2048',
            'title' => 'required|max:100',
            'category' => 'required',
            'body' => 'required',
            'user' => 'required',
        ]);
        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('post-cover');
        }
        $validatedData['user_id'] = User::where('name', "LIKE", "%" . $request->user . "%")->first()->id;
        $validatedData['category_id'] = Category::where('name', "LIKE", "%". $request->category . "%")->first()->id;
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);
        Post::where('slug', $slug)->update($validatedData);
        return response("data updated");
    }
});
// delete post
Route::delete('delete-post/{slug}', function($slug){
    Post::where('slug', $slug)->delete();
});

// CATEGORY
// get all categories
Route::get('/get-categories',function(){
    $data = Category::latest()->get();
    return $data;
});
// get one category
Route::get('/get-one-category/{id}',function($id){
    $data = Category::latest()->where('id', $id)->get();
    return $data;
});
// delete category
Route::delete('delete-category/{id}', function($id){
    Category::where('id', $id)->delete();
});

// USER
// get all users
Route::get('/get-users',function(){
    $data = User::latest()->get();
    return $data;
});
// get user role admin
Route::get('/get-admin',function(){
    $data = User::latest()->where('role', 1)->get();
    return $data;
});
// get user role user
Route::get('/get-user',function(){
    $data = User::latest()->where('role', null)->get();
    return $data;
});
// get one user
Route::get('/get-one-user/{id}',function($id){
    $data = User::latest()->where('id', $id)->get();
    return $data;
});
// delete user
Route::delete('delete-user/{id}', function($id){
    User::where('id', $id)->delete();
});

