@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    {{-- <hr> --}}
    <div class="container-fluid">
        <div class="card-group">
            <div class="row row-cols-md-2 g-4 mx-3 my-4">
                @foreach ($posts as $post)
                    {{-- every post --}}
                    <div class="flex justify-center">
                        <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                            <img class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                src="https://source.unsplash.com/full/?landscape" alt="" />
                            <div class="p-6 flex flex-col justify-start">
                                <h5 class="text-gray-900 text-xl font-medium mb-2">{{ $post->title }}</h5>
                                <p class="text-gray-700 text-base mb-2">{{ $post->body }}
                                </p>
                                <p class="text-gray-800 text-xs mb-4">In Category {{ $post->category }}</p>
                                <p class="text-gray-600 text-xs">Last update on {{ $post->updated_at }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
