<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use App\Models\Saved;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        // if (!Gate::allows('isUser')) {
        //     abort(403);
        // }

        $user = User::with('saveds')->first();
        $post = Post::with('saveds')->first();

        // dd($post->saveds);
        // dd($user->saveds);

        // $post->saveds()->attach($user);
        // $saved = Post::with('savedpost.posts');

        // $savepost = Post::with(['user', 'savedpost.user']);
        // $saveds = Saved::latest()->get();
        // dd($saveds->user());
        // dd($savepost);

        // $query = Post::with(['user', 'saveds'])->get();

        $query = Post::latest()->filter(request(['cari']))->where('status', null);
        // dd($query->saveds->first()->pivot->user_id);
        // $query = DB::table('posts')->join('saveds', 'posts.id', '=', 'saveds.post_id')
        //     ->join('categories', 'posts.category_id', '=', 'categories.id')
        //     ->join('users', 'posts.user_id', '=', 'users.id')
        //     ->latest('posts.created_at');
        // $query = Post::with(['user', 'savedpost.user'])->latest();
        // if (request('cari')) {
        //     $query->where('title', 'like', '%' . request('cari') . '%')
        //         ->orWhere('body', 'like', '%' . request('cari') . '%');
        //     // ->orWhere('category', 'like', '%' . request('cari') . '%');
        // }
        return view('home', [
            'title' => 'Blog | Home',
            'page' => 'All Post',
            'posts' => $query->paginate(8)->withQueryString(),
            // 'posts' => $query,
            // 'saved' => $query->saveds->first()->pivot
        ], compact('query'));
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
        if (!Gate::allows('isUser')) {
            abort(403);
        }
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
