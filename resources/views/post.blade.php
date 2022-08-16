@extends('layouts.main')
@section('container')
    <div class="mt-1 sm:mt-0">
        <div class="ps-4 pb-4 sm:px-0">
            <h3 class="text-lg font-medium leading-0 text-gray-900">{{ $page }}</h3>
        </div>
        <div class="container-fluid">
            {{-- <div class="card-group"> --}}
            <div class="row row-cols-md-2 g-4 mx-3 my-4">
                {{-- single post --}}
                <div class="flex justify-center">
                    <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg">
                        @if ($post->cover)
                            <img class="w-48 h-84 md:h-auto object-cover md:w-42 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                src="{{ asset('storage/' . $post->cover) }}" alt="" />
                        @else
                            <img class="w-48 h-84 md:h-auto object-cover md:w-42 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                src="https://source.unsplash.com/200x200/?{{ $post->category_id }}" alt="" />
                        @endif
                        <div class="p-6 flex flex-col justify-start">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">
                                {{ Str::of($post->title)->words(10, '') }}
                            </h5>
                            <p class="text-gray-700 text-justify text-base mb-2">
                                {!! Str::of($post->body)->words(20, ' read more...') !!}
                            </p>
                            <p class="text-gray-800 text-xs mt-2">In Category : {{ $post->category_id }}</p>
                            <p class="text-gray-900 text-sm my-2 font-bold">By
                                {{ Str::of($post->user_id)->words(3, '') }}</p>
                            <p class="text-gray-600 text-xs mt-2">Last update on
                                {{ $post->updated_at }}
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
                {{-- </div> --}}
            </div>
        </div>
    @endsection
