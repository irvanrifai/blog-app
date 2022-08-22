<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit" id="editItem"><span class="badge bg-success">activated</span></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="delete" id="deleteItem"><span class="badge bg-danger">deactived</span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $users = User::latest()->get();
        return view('admin.user_datatable', [
            'title' => 'Blog | Admin',
            'page' => 'Manage User Activity',
            'users' => $users
        ], compact('users'));
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
