<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit" id="editItem"><span class="badge bg-warning text-dark"><i class="fa fa-pencil"></i></span></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="delete" id="deleteItem"><span class="badge bg-danger"><i
                    class="fa fa-trash"></i></span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $category = category::latest()->get();
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
    public function store(StorecategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
