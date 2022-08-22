@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <div class="container-fluid">
        <div class="row">

            <!-- total post -->
            <div class="col-xl-4 mb-4 mt-3">
                <div class="card border-primary rounded-lg shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Post Amount</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $posts->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-table fa-2x text-gray-300" style="color:darkblue; opacity:60%;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- total user -->
            <div class="col-xl-4 mb-4 mt-3">
                <div class="card border-success rounded-lg shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">User Amount
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300" style="color:green; opacity:60%;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- total category -->
            <div class="col-xl-4 mb-4 mt-3">
                <div class="card border-warning rounded-lg shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Category Amount
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $category->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300" style="color:orange; opacity:60%;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2xl-8 mb-4 mt-3">
                <div class="card border-secondary rounded-lg shadow h-500 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 text-gray-400">Activities User Documented</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2xl-8 mb-4 mt-3">
                <div class="card border-secondary rounded-lg shadow h-500 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 text-gray-400">Activities Admin Documented</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
