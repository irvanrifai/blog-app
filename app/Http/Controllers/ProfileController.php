<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // nanti disini pakai datatable, sementara passing data biasa dulu
        return view('manipulate_profile', [
            'title' => 'Blog | Profile',
            // 'page' => Str::of(auth()->user()->name)->words(2, '') . "'s saved post",
            // 'posts' => Post::latest()->where('category', 'General')->get(),
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
        return view('manipulate_profile');
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
        $validatedData = Validator::make($request->all(), [
            'photo' => 'file|image|max:2048',
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'fb_account' => 'max:100',
            'twt_account' => 'max:100',
            'ig_account' => 'max:100',
            'linkedin_account' => 'max:100',
            'github_account' => 'max:100',
            'email' => 'required|email:dns|max:70',
            'password' => 'required|min:8|max:40',
        ]);
        if ($validatedData->fails()) {
            return redirect(url('profile'))->withInput()->withErrors($validatedData);
        } else {
            User::where('id', $user->id)->update($validatedData->validate());
            Alert::toast('Update Profile Successfull', 'success');
            return redirect(url('profile'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        Post::destroy($user->id, $id);
        Alert::toast('Delete Profile Successfull', 'success');
        return redirect(url('/signin'));
    }
}