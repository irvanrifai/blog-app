<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MypostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home', [
            'title' => 'Blog | My Post',
            'page' => Str::of(auth()->user()->name)->words(2, '') . "'s post",
            'posts' => Post::latest()->where('category', 'Web App')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(url('mypost/create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'cover' => 'file|image|max:2048',
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
            'body' => 'required',
            'category' => 'required',
        ]);
        if ($validatedData->fails()) {
            return redirect(url('mypost/create'))->withInput()->withErrors($validatedData);
        } else {
            Post::create($validatedData->validate());
            Alert::toast('New Post Upload Successfull', 'success');
            return redirect(url('/mypost'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('manipulate_post', [
            'id' => $post->slug
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('mypost');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'cover' => 'file|image|max:2048',
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
            'body' => 'required',
            'category' => 'required',
        ]);
        if ($validatedData->fails()) {
            return redirect(url('mypost/create'))->withInput()->withErrors($validatedData);
        } else {
            Post::where('id', $id)->update($validatedData->validate());
            Alert::toast('Update Post Successfull', 'success');
            return redirect(url('/mypost'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        Post::destroy($post->id, $id);
        Alert::toast('Delete Post Successfull', 'success');
        return redirect(url('/mypost'));
    }
}
