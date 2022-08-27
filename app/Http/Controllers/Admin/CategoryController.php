<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
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
            $data = Category::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('create_at', function ($data) {
                    return $data->created_at->diffForHumans();
                })
                ->addColumn('update_at', function ($data) {
                    return $data->updated_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit" id="editItem"><span class="badge bg-warning text-dark"><i class="fa fa-pencil"></i></span></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="delete" id="deleteItem"><span class="badge bg-danger"><i
                    class="fa fa-trash"></i></span></a>';
                    return $btn;
                })
                ->rawColumns(['create_at', 'update_at', 'action'])
                ->make(true);
        }
        $category = Category::latest()->get();
        return view('admin.category', [
            'title' => 'Blog | Admin',
            'page' => 'Manage Post Category',
            'categories' => $category
        ], compact('category'));
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
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $data = Category::updateOrCreate(['name' => $request->name], ['id' => $request->data_id], ['slug' => SlugService::createSlug(Category::class, 'slug', $request->name)]);
        $data = Category::updateOrCreate(['name' => $request->name], ['id' => $request->data_id], ['slug' =>  $request->slug]);
        return response()->json($data);
        // if ($validatedData->fails()) {
        //     Alert::toast('Add New Category Unsuccessfull', 'error');
        // } else {
        //     $validatedData = $request->validate([
        //         'name' => 'required|max:100',
        //     ]);
        //     $validatedData['slug'] = SlugService::createSlug(Category::class, 'slug', $validatedData['name']);
        //     $data = Category::updateOrCreate($validatedData, ['id' => $request->data_id]);
        //     Alert::toast('New Post Upload Successfull', 'success');
        //     return response()->json($data);
        // }

        // $data = Category::updateOrCreate(
        //     ['id' => $request->data_id],
        //     ['name' => $request->name],
        //     ['slug' => $request->slug],
        // );
        // return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (!Gate::allows('isUser')) {
            abort(403);
        }
        $categories = Category::with('post')->where('id', $category->id)->first();
        return view('category', [
            'title' => 'Post | Category',
            'page' => $categories->name,
            'categories' => $categories->paginate(10)
        ], compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $data = Category::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $data = Category::where('id', $id)->delete();
        return response()->json($data);
    }
}
