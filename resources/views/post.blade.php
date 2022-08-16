@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <div class="flex justify-center">
        <div class="rounded-lg shadow-lg bg-white max-w-4xl max-h-2xl">
            @if ($post->cover)
                <img class="w-full h-full sm:h-50 object-cover sm:w-60 rounded-t-lg"
                    src="{{ asset('storage/' . $post->cover) }}" alt="" />
            @else
                <img class="w-full h-full sm:h-full object-cover sm:w-full rounded-t-lg"
                    src="https://source.unsplash.com/2500x500/?{{ $post->category_id }}" alt="" />
            @endif
            <div class="p-6">
                <h5 class="text-gray-900 text-xl font-medium mb-2">{{ Str::of($post->title)->words(10, '') }}</h5>
                <p class="text-gray-700 text-base mb-4">
                    {!! Str::of($post->body)->words(20, ' read more...') !!}
                </p>
                <p class="text-gray-800 text-xs mt-2">In Category : {{ $post->category_id }}</p>
                <p class="text-gray-900 text-sm my-2 font-bold">By
                    {{ Str::of($post->user_id)->words(3, '') }}</p>
                <p class="text-gray-600 text-xs mt-2">Last update on
                    {{ $post->updated_at }}
                </p>
                <a class="text-right pt-6 text-gray-500 text-xl pe-4 md:text-left sm:text-right sm:py-6" href="#"><i
                        class="fa fa-bookmark"></i></a>
                {{-- <a class="text-right py-6 text-blue-600 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                href="#"><i class="fa fa-bookmark"></i></a> --}}

                {{-- tombol edit, only my post --}}
                @if (auth()->user()->id == $post->user_id)
                    <a class="text-right py-4 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                        href="mypost/{{ $post->slug }}/edit"><i class="fa fa-pencil"></i></a>
                @endif
                <button type="button"
                    class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Button</button>
            </div>
        </div>
    </div>
@endsection
