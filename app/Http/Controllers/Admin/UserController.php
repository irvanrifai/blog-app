<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
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
            $data = User::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($data) {
                    if ($data->role == 1) {
                        $btn = '<span class="badge bg-primary">Admin</span>';
                    } else if ($data->role == null) {
                        $btn = '<span class="badge bg-info">User</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 'active') {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="activated" class="manipulate" id="manipulateItem"><span class="badge bg-success">activated</span></a>';
                    } else if ($data->status == 'deactivated') {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="deactivated" class="manipulate" id="manipulateItem"><span class="badge bg-danger">deactivated</span></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }
        $users = User::latest()->get();
        // dd($users);
        return view('admin.user_datatable', [
            'title' => 'Blog | Admin',
            'page' => 'Manage User Activity',
            'users' => $users,
            'profile' => auth()->user(),
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
        $data = User::updateOrCreate(
            ['id' => $request->data_id],
            ['status' => $request->btn_act],
            ['status' => $request->act]
        );
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $data = User::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
