@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <div class="flex justify-center">
        <div class="flex flex-col md:flex-row md:max-w-5xl rounded-lg bg-white shadow-lg">
            @if ($posts->cover)
                <img class="w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                    src="{{ asset('storage/' . $posts->cover) }}" alt="" />
            @else
                <img class="w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                    src="https://source.unsplash.com/2500x500/?{{ $posts->category->name }}" alt="" />
            @endif
            <div class="py-3 px-4">
                <h5 class="text-gray-900 text-xl font-medium mb-1">{{ Str::of($posts->title)->words(10, '') }}</h5>
                <div class="text-left">
                    <p class="text-gray-700 text-base py-2">
                        {!! $posts->body !!}
                        {{-- {!! Str::of($posts->body)->words(20, ' read more...') !!} --}}
                    </p>
                    <p class="text-gray-800 text-xs mt-2">In Category : {{ $posts->category->name }}</p>
                    <p class="text-gray-900 text-sm my-2 font-bold">By
                        {{ $posts->user->name }}</p>
                    {{-- {{ Str::of($posts->user->name)->words(3, '') }}</p> --}}
                    <p class="text-gray-600 text-xs mt-2">Last update on
                        {{ $posts->updated_at->diffForHumans() }}
                    </p>
                </div>
                <div class="text-right py-2">
                    {{-- kondisi saved/unsave --}}
                    <a class="text-right pt-6 text-gray-500 text-xl pe-4 md:text-left sm:text-right sm:py-6"
                        href="#"><i class="fa fa-bookmark"></i></a>
                    {{-- <a class="text-right py-6 text-blue-600 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                href="#"><i class="fa fa-bookmark"></i></a> --}}

                    {{-- tombol edit, only my post --}}
                    @if (auth()->user()->id == $posts->user_id)
                        <a class="text-right py-4 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                            href="{{ url('user/mypost/' . $posts->slug . '/edit') }}"><i class="fa fa-pencil"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
