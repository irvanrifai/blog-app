<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guest.signin', [
            'title' => 'Blog | Sign In',
        ]);
    }

    public function indexSignup()
    {
        return view('guest.signup', [
            "title" => "Blog | SignUp"
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
                    Alert::toast('Sign In Successfull' . '<br>' . 'Hello, ' . Str::of(auth()->user()->name)->words(2, ''), 'success');
                    return redirect()->intended(url('user/mypost'));
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
                return redirect('guest/signin');
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

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // $request->session()->flash('success_logout_a', 'Logout success!');
        Alert::toast('Sign Out Successfull', 'success');
        return redirect('guest/signin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email:dns|max:70',
            'password' => 'required|min:8|max:40',
            'remember_token' => Str::random(10),
            'role' => 'max:10'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        Alert::toast('Sign Up Successfull, Please Login', 'success');
        return redirect('auth/signin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
