@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    {{-- <hr> --}}
    <div class="container-fluid">
        <div class="fixed-bottom text-right sm:px-14 py-14 px-10">
            <a class="text-gray-600 px-3 py-2 bg-gray-400 shadow-xl text-xl hover:text-2xl font-bold rounded-full mr-1 ease-linear"
                href="{{ url('mypost/create') }}"><i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="card-group">
            <div class="row row-cols-md-2 g-4 mx-3 my-4">
                @foreach ($posts as $post)
                    {{-- every post --}}
                    <div class="flex justify-center">
                        <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg">
                            @if ($post->cover)
                                <img class="w-48 h-84 md:h-auto object-cover md:w-42 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                    src="{{ asset('storage/' . $post->cover) }}" alt="" />
                            @else
                                <img class="w-48 h-84 md:h-auto object-cover md:w-42 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                    src="https://source.unsplash.com/200x200/?{{ $post->category->name }}" alt="" />
                            @endif
                            <div class="p-6 flex flex-col justify-start">
                                <h5 class="text-gray-900 text-xl font-medium mb-2">
                                    {{ Str::of($post->title)->words(10, '') }}
                                </h5>
                                <p class="text-gray-700 text-justify text-base mb-2">
                                    {!! Str::of($post->body)->words(20, ' read more...') !!}
                                </p>
                                <p class="text-gray-800 text-xs mt-2">In Category : {{ $post->category->name }}</p>
                                <p class="text-gray-900 text-sm my-2 font-bold">By
                                    {{ Str::of($post->user->name)->words(3, '') }}</p>
                                <p class="text-gray-600 text-xs mt-2">Last update on
                                    {{ $post->updated_at->diffForHumans() }}
                                </p>
                            </div>
                            {{-- kasih kondisi saved/not saved --}}
                            <a class="text-right pt-6 text-gray-500 text-xl pe-4 md:text-left sm:text-right sm:py-6"
                                href="#"><i class="fa fa-bookmark"></i></a>
                            {{-- <a class="text-right py-6 text-blue-600 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                href="#"><i class="fa fa-bookmark"></i></a> --}}

                            {{-- tombol edit, only my post --}}
                            @if (auth()->user()->id == $post->user_id)
                                <a class="text-right py-4 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                    href="mypost/{{ $post->slug }}/edit"><i class="fa fa-pencil"></i></a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
