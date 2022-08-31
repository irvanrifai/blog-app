@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <div class="container-fluid">
        <div class="fixed-bottom text-right sm:px-14 py-14 px-10 shadow-xl">
            <a class="text-gray-200 px-2.5 py-1.5 bg-blue-600 text-xl hover:text-2xl hover:text-slate-300 font-bold rounded-full mr-1 ease-linear"
                href="{{ url('user/mypost/create') }}"><i class="fa fa-plus"></i> New post
            </a>
        </div>
        <div class="card-group" id="posts">
            <div class="row row-cols-md-2 g-4 mx-3 my-4">
                @forelse ($posts as $post)
                    {{-- <p>{{ $post->saveds->first()->pivot->user_id }}</p> --}}
                    {{-- every post --}}
                    <div class="flex justify-center hover:bg-gray-200 hover:rounded-xl" id="post">
                        <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg">
                            @if ($post->cover)
                                <img class="w-full h-42 sm:h-21 object-cover sm:w-40 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                    src="{{ asset('storage/' . $post->cover) }}" alt="" />
                            @else
                                <img class="w-full h-42 sm:h-21 object-cover sm:w-40 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                    src="https://source.unsplash.com/200x200/?{{ $post->category->name }}" alt="" />
                            @endif
                            <div class="p-6 flex flex-col justify-start">
                                <a href="{{ url('user/mypost' . '/' . $post->slug) }}">
                                    {{-- <a href="{{ url('user/post') }}"> --}}
                                    <h5 class="text-gray-900 hover:text-blue-700 text-xl font-medium mb-2">
                                        {{ Str::of($post->title)->words(10, '') }}
                                    </h5>
                                </a>
                                <p class="text-gray-700 text-justify text-base mb-2">
                                    {!! Str::of($post->body)->words(20, ' read more...') !!}
                                </p>
                                <p class="text-gray-800 text-xs mt-2">In Category :
                                    <a
                                        href="{{ url('user/category') . '/' . $post->category->id }}">{{ $post->category->name }}</a>
                                </p>
                                <p class="text-gray-900 text-sm my-2 font-bold">By
                                    <a
                                        href="{{ url('user/profile') . '/' . $post->user->username }}">{{ Str::of($post->user->name)->words(3, '') }}</a>
                                </p>
                                <p class="text-gray-600 text-xs mt-2">Last update on
                                    {{ $post->updated_at->diffForHumans() }}
                                    {{-- {{ $post->saveds->user_id }} --}}
                                </p>
                            </div>

                            {{-- kasih kondisi saved/not saved --}}
                            {{-- masih error, entah relationship atau apanya --}}
                            <div class="flex px-4">

                                {{-- <h2>{{ dd($post->saveds) }}</h2> --}}
                                {{-- <p>{{ $post->saveds->first()->pivot->user_id }}</p> --}}
                                {{-- <p>{{ dd($post->saveds->all()->pivot->user_id) }}</p> --}}
                                {{-- @if (auth()->user()->id == $save->first()->pivot->user_id) --}}
                                {{-- @if (auth()->user()->id == $post->saveds->id) --}}
                                @auth
                                    {{-- @if (auth()->user()->id == null) --}}
                                    {{-- @if (auth()->user()->id == $post->user->id) --}}
                                    <a class="text-right py-4 text-blue-600 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                        href="javascript:void(0)" id="saved"><i class="fa fa-bookmark"></i></a>
                                    {{-- @else --}}
                                    <a class="text-right py-4 text-gray-500 text-xl pe-4 md:text-left sm:text-right sm:py-6"
                                        href="javascript:void(0)" id="save"><i class="fa fa-bookmark"></i></a>
                                    {{-- @endif --}}
                                @endauth

                                {{-- scrpit for saved-unsaved button --}}
                                <script type="text/javascript">
                                    $(function() {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });

                                        // coba buat sendiri
                                        $save = $("#save");
                                        $saved = $("#saved");

                                        if ($save.length) {
                                            $save.on('click', function() {
                                                var post_id = $(this).data("post_id");
                                                $.ajax({
                                                        url: "{{ url('user/savedpost') }}",
                                                        type: "POST",
                                                        data: {
                                                            id: post_id,
                                                            _token: '{{ csrf_token() }}'
                                                        },
                                                        dataType: 'json',
                                                        enctype: 'multipart/form-data',
                                                        success: function(data) {
                                                            table.draw();
                                                        },
                                                        error: function(data) {
                                                            console.log('Error:', data);
                                                        }
                                                    }
                                                    // , function(response) {
                                                    //     // do something with your response from SavedController.php:
                                                    //     $save.addClass("unlike");
                                                    //     $save.removeClass("like");
                                                    //     $saved = $save;
                                                    // }
                                                );
                                            });
                                        }

                                        if ($saved.length) {
                                            $saved.on('click', function() {
                                                var post_id = $(this).data("post_id");
                                                $.ajax({
                                                        url: "{{ url('user/savedpost') }}" + '/' + post_id,
                                                        type: "delete",
                                                        data: {
                                                            id: post_id,
                                                            _token: '{{ csrf_token() }}'
                                                        },
                                                        dataType: 'json',
                                                        enctype: 'multipart/form-data',
                                                        success: function(data) {
                                                            table.draw();
                                                        },
                                                        error: function(data) {
                                                            console.log('Error:', data);
                                                        }
                                                    }
                                                    // , function(response) {
                                                    //     // do something with your response from SavedController.php:
                                                    //     $saved.addClass("like");
                                                    //     $saved.removeClass("unlike");
                                                    //     $save = $saved;
                                                    // }
                                                );
                                            });
                                        }
                                    })
                                </script>

                                {{-- tombol edit, only my post --}}
                                @auth
                                    @if (auth()->user()->id == $post->user_id)
                                        {{-- @if (auth()->user()->id == $post->user_id) --}}
                                        <a class="text-right py-2 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                            href="mypost/{{ $post->slug }}/edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-8">
                        <h1 class="text-gray-700 text-2xl font-bold">Hello, {{ auth()->user()->name }}!</h1>
                        <h1 class="text-gray-800 text-xl font-bold">Get your first post!</h1>
                        <div class="text-center sm:px-14 py-14 px-10">
                            <a class="text-gray-600 px-4 py-3 bg-gray-300 shadow-xl text-xl hover:text-2xl font-bold rounded-full mr-1 ease-linear"
                                href="{{ url('user/mypost/create') }}"><i class="fa fa-plus"></i>
                            </a>
                            <i>click now!</i>
                        </div>
                    </div>
                @endforelse
            </div>
            {{-- </div> --}}
        </div>
        {{ $posts->links() }}
    </div>
    <script>
        $(document).ready(function() {
            var select = $('#posts');

            $('#posts div').on('click', '#post', function() {
                $(this).toggleClass('bg-gray-300');
                $(this).toggleClass('rounded-xl');
            });
        });
    </script>
@endsection
