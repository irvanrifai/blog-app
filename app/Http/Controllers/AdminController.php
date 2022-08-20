<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest();
        $users = User::latest();
        $category = category::latest();
        return view('admin.dashboard', [
            'title' => 'Blog | Admin',
            'page' => 'Dashboard',
            'posts' => $posts,
            'users' => $users,
            'category' => $category
        ], compact('posts', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.signup_admin', [
            "title" => "Admin | SignUp",
            'page' => 'Sign Up for Administrator',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email:dns|max:70',
            'role' => 'max:10',
            'password' => 'required|min:8|max:40',
            'remember_token' => Str::random(10),
        ]);

        if ($request->validate('role')) {
            $validatedData['role'] = 1;
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        Alert::toast('Sign Up Successfull, Please Login', 'success');
        return redirect('/signin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
