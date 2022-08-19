<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Saved;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        $saved = Post::where('user_id', auth()->user()->id)->whereHas('savedpost', function ($q) {
            $q->where('post_id', true);
        })->get();

        // $savepost = Post::with(['user', 'savedpost.user']);
        // $saveds = Saved::all();
        // dd($saveds);
        // dd($savepost);
        $query = Post::latest();
        // $query = Post::with(['user', 'savedpost.user'])->latest();
        if (request('cari')) {
            $query->where('title', 'like', '%' . request('cari') . '%')
                ->orWhere('body', 'like', '%' . request('cari') . '%')
                ->orWhere('category', 'like', '%' . request('cari') . '%');
        }
        return view('home', [
            'title' => 'Blog | Home',
            'page' => 'All Post',
            'posts' => $query->paginate(10)->withQueryString(),
            // 'posts' => $query,
            // 'saved' => $savepost
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $slug)
    {
        $posts = Post::where('slug', $slug)->first();
        return view('post', [
            'title' => 'Blog | Post',
            'page' => 'Detail Post',
            'posts' => $posts
        ], compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
