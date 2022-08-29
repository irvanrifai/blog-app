<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Saved;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSavedRequest;
use App\Http\Requests\UpdateSavedRequest;
use App\Models\User;
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
        // masih belum jalan
        // $posts = Post::with('user', 'saveds')->latest()->where('user_id', auth()->user()->id);
        // $posts = Saved::with('user', 'post')->latest();
        $usersavepost = User::latest()->find(auth()->user()->id);
        $saved = $usersavepost->saveds()->paginate(8);
        // dd($usersavepost->saveds);
        // dd($savedpost = Saved::where('user_id', auth()->user()->id)->get());
        // $posts = $savedpost->where($savedpost->saveds->first()->pivot->user_id, auth()->user()->id);
        // dd($savedpost->saveds->first()->pivot->user_id);
        // $posts = Saved::latest()->where('user_id', auth()->user()->id);
        return view('home', [
            'title' => 'Blog | Saved',
            'page' => Str::of(auth()->user()->name)->words(2, '') . "'s saved post",
            'posts' => $saved,
            // 'posts' => $savedpost,
        ], compact('usersavepost', 'saved'));
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
        $data = Saved::create(
            ['user_id' => auth()->user()->id, 'post_id' => $request->post_id],
        );
        return response()->json($data);
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
    public function destroy(Saved $saved, $id_post)
    {
        $data = Saved::where('id_post', $id_post)->delete();
        return response()->json($data);
    }
}
