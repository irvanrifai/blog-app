<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        }
        return view('user.manipulate_profile', [
            'title' => 'Blog | Profile',
            'profile' => auth()->user(),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $username)
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        }
        // $users = $user->where('username', $username);
        // dd($users->where('username', $username)->get());
        $posts = $user->posts;
        return view('profile', [
            'title' => 'Profile | User',
            'page' => 'Detail Profile',
            'users' => $user->where('username', $username)->get(),
            'posts' => $posts
        ], compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        }
        return view('user.manipulate_profile', [
            'title' => 'Blog | Profile',
            'profile' => auth()->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $username)
    {
        // $user_id = auth()->user()->id;
        $validatedData = Validator::make($request->all(), [
            'photo' => 'image|file|max:2048',
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'fb_account' => 'max:100',
            'twt_account' => 'max:100',
            'ig_account' => 'max:100',
            'linkedin_account' => 'max:100',
            'github_account' => 'max:100',
            'email' => 'required|email:dns|max:70',
            // 'password' => 'min:8|max:40',
        ]);
        if ($validatedData->fails()) {
            Alert::toast('Update Profile Unsuccessfull', 'error');
            return redirect(url('user/profile'))->withInput()->withErrors($validatedData);
        } else {
            $validatedData = $request->validate([
                'photo' => 'image|file|max:2048',
                'name' => 'required|max:100',
                'username' => 'required|max:100',
                'fb_account' => 'max:100',
                'twt_account' => 'max:100',
                'ig_account' => 'max:100',
                'linkedin_account' => 'max:100',
                'github_account' => 'max:100',
                'email' => 'required|email:dns|max:70',
            ]);
            if ($request->file('photo')) {
                $validatedData['photo'] = $request->file('photo')->store('user-photo');
            }
            User::where('username', $username)->update($validatedData);
            Alert::toast('Update Profile Successfull', 'success');
            return redirect(url('user/profile'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $username)
    {
        User::where('username', $username)->delete();
        Alert::toast('Delete Account Successfull', 'success');
        return redirect(url('guest'));
    }

    public function setting()
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        }
        return view('user.profile_setting', [
            'title' => 'Blog | Setting',
            'profile' => auth()->user()
        ]);
    }
}
