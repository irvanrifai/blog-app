<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Saved;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Gate;

class MypostController extends Controller
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
        } elseif (!Gate::allows('read_post')) {
            abort(403);
        }
        $posts = Post::latest()->where('user_id', auth()->user()->id);
        return view('home', [
            'title' => 'Blog | My Post',
            'page' => Str::of(auth()->user()->name)->words(2, '') . "'s post",
            'posts' => $posts->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        } elseif (!Gate::allows('create_post')) {
            abort(403);
        }
        return view('add_post', [
            'title' => 'Blog | New Post',
            'page' => 'New Post',
            'posts' => Post::latest()->get(),
            'categories' => Category::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create_post')) {
            abort(403);
        }
        $validatedData = Validator::make($request->all(), [
            'cover' => 'image|file|max:2048',
            'title' => 'required|max:100',
            'category' => 'required',
            'body' => 'required',
        ]);


        if ($validatedData->fails()) {
            Alert::toast('New Post Upload Unsuccessfull', 'error');
            return redirect(url('mypost/create'))->withInput()->withErrors($validatedData);
        } else {
            $validatedData = $request->validate([
                'cover' => 'image|file|max:2048',
                'title' => 'required|max:100',
                'category' => 'required',
                'body' => 'required',
            ]);
            if ($request->file('cover')) {
                $validatedData['cover'] = $request->file('cover')->store('post-cover');
            }
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['category_id'] = $validatedData['category'];
            $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);
            Post::create($validatedData);
            Alert::toast('New Post Upload Successfull', 'success');
            return redirect(url('mypost'));
        }
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
            'page' => $posts->title,
            'posts' => $posts
        ], compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $slug)
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        }
        $post = Post::where('slug', $slug)->first();
        return view('manipulate_post', [
            'title' => 'Blog | Edit Post',
            'page' => 'Edit Post',
            'post' => $post,
            'categories' => Category::latest()->get()
        ], compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $slug)
    {
        if (!Gate::allows('update_post')) {
            abort(403);
        }
        $validatedData = Validator::make($request->all(), [
            'cover' => 'image|file|max:2048',
            'title' => 'required|max:100',
            'category' => 'required',
            'body' => 'required',
        ]);
        if ($validatedData->fails()) {
            Alert::toast('Update Post Unsuccessfull', 'error');
            return redirect(url('mypost/' . $slug . '/edit'))->withInput()->withErrors($validatedData);
        } else {
            $validatedData = $request->validate([
                'cover' => 'image|file|max:2048',
                'title' => 'required|max:100',
                // 'category' => 'required',
                'body' => 'required',
            ]);
            if ($request->file('cover')) {
                $validatedData['cover'] = $request->file('cover')->store('post-cover');
            }
            $validatedData['user_id'] = auth()->user()->id;
            // $validatedData['category_id'] = $validatedData['category'];
            $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);
            Post::where('slug', $slug)->update($validatedData);
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
    public function destroy(Post $post, $slug)
    {
        // Post::destroy($post->slug);
        // Post::destroy('slug', $slug);
        if (!Gate::allows('delete_post')) {
            abort(403);
        }
        Post::where('slug', $slug)->delete();
        Alert::toast('Delete Post Successfull', 'success');
        return redirect(url('/mypost'));
    }
}
