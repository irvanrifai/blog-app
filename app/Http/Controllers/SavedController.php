<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Saved;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSavedRequest;
use App\Http\Requests\UpdateSavedRequest;
use Illuminate\Http\Request;

class SavedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::latest()->where('category_id', '4');
        return view('home', [
            'title' => 'Blog | Saved',
            'page' => Str::of(auth()->user()->name)->words(2, '') . "'s saved post",
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSavedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSavedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saved  $saved
     * @return \Illuminate\Http\Response
     */
    public function show(Saved $saved)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saved  $saved
     * @return \Illuminate\Http\Response
     */
    public function edit(Saved $saved)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSavedRequest  $request
     * @param  \App\Models\Saved  $saved
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavedRequest $request, Saved $saved)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saved  $saved
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saved $saved)
    {
        //
    }
}
