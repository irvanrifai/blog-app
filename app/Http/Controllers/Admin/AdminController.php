<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $posts = Post::latest();
        $users = User::latest();
        $category = Category::latest();
        return view('admin.dashboard', [
            'title' => 'Blog | Admin',
            'page' => 'Dashboard',
            'posts' => $posts,
            'users' => $users,
            'category' => $category
        ], compact('posts', 'users'));
    }

    public function indexSignin()
    {
        return view('admin.signin_admin', [
            "title" => "Admin | Sign In",
            'page' => 'Sign In for Administrator',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        return view('admin.signup_admin', [
            "title" => "Admin | Sign Up",
            'page' => 'Sign Up for Administrator',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            if (auth()->user()->status == 'active') {
                if (auth()->user()->role == null) {
                    $request->session()->regenerate();
                    Alert::toast('Sign In Unsuccessfull, Admin Credentials Only', 'success');
                    // Alert::toast('Sign In Successfull' . '<br>' . 'Hello, ' . Str::of(auth()->user()->name)->words(2, ''), 'success');
                    // return redirect()->intended(url('user/mypost'));
                } elseif (auth()->user()->role == 1) {
                    $request->session()->regenerate();
                    Alert::toast('Sign In Successfull' . '<br>' . 'Hello, ' . Str::of(auth()->user()->name)->words(2, ''), 'success');
                    return redirect()->intended(url('admin'));
                }
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Alert::toast("Sign In Unsuccessfull, Your Account Has Been Deactivated, Please Contact Administrator", 'warning');
                return redirect('admin/signin');
            }
        } else {
            Alert::toast("Sign In Unsuccessfull, Your Credentials Doesn't match", 'error');
            return back()
                ->with([
                    'error_login' => "Your Credentials Doesn't match"
                ])
                ->withErrors('Error Sign In', 'error')
                ->onlyInput('email');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email:dns|max:70',
            'role' => 'max:10',
            'password' => 'required|min:8|max:40',
            'remember_token' => Str::random(10),
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        Alert::toast('Sign Up Successfull, Please Login', 'success');
        return redirect(url('admin/signin'));
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
