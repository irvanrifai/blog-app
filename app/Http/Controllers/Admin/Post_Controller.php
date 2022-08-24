<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Post_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        if ($request->ajax()) {
            // $categories = Category::latest();
            $data = Post::with('category')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('body', function ($data) {
                    return $btn = Str::of($data->body)->words('10', '...');
                })
                ->addColumn('dateupload', function ($data) {
                    return $btn = $data->created_at->diffForHumans();
                })
                ->addColumn('dateupdate', function ($data) {
                    return $btn = $data->updated_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == null) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="takedown" class="takedown" id="manipulateItem"><span class="badge bg-danger">takedown</span></a>';
                    } else if ($data->status == 1) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="restore" class="restore" id="manipulateItem"><span class="badge bg-success">restore</span></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['body', 'dateupdate', 'dateupload', 'action'])
                ->escapeColumns('active')
                ->make(true);
        }
        $posts = Post::latest()->get();
        return view('admin.post_datatable', [
            'title' => 'Blog | Admin',
            'page' => 'Manage Post User Activity',
            'posts' => $posts,
        ], compact('posts'));
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = Post::updateOrCreate(
            ['id' => $request->data_id],
            ['status' => $request->status]
        );
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $Category, $id)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $data = Post::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $Category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $Category)
    {
        //
    }
}
