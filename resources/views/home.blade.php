@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    {{-- <hr> --}}
    <div class="container-fluid">
        <div class="fixed-bottom text-right sm:px-14 py-14 px-10">
            <a class="text-gray-600 px-3 py-2 bg-gray-400 shadow-xl text-xl font-bold rounded-full mr-1 ease-linear"
                href="{{ url('create') }}"><i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="card-group">
            <div class="row row-cols-md-2 g-4 mx-3 my-4">
                @foreach ($posts as $post)
                    {{-- every post --}}
                    <div class="flex justify-center">
                        <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg">
                            <img class="w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                src="https://source.unsplash.com/200x200/?landscape" alt="" />
                            <div class="p-6 flex flex-col justify-start">
                                <h5 class="text-gray-900 text-xl font-medium mb-2">{{ $post->title }}</h5>
                                <p class="text-gray-700 text-base mb-2">{{ $post->body }}
                                </p>
                                <p class="text-gray-800 text-xs mb-4">(Sementara)In Category {{ $post->title }}</p>
                                <p class="text-gray-600 text-xs">Last update on {{ $post->updated_at->diffForHumans() }}
                                </p>
                            </div>
                            {{-- kasih kondisi saved/not saved --}}
                            <a class="text-right py-6 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                href="#"><i class="fa fa-bookmark"></i></a>
                            {{-- <a class="text-right py-6 text-blue-600 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                href="#"><i class="fa fa-bookmark"></i></a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
