@extends('layouts.main')
@section('container')
    <h1>{{ $page }}</h1>
    <div class="card-group" id="posts">
        <div class="row row-cols-md-2 g-4 mx-3 my-4">
            @foreach ($categories as $post)
                {{-- <p>{{ $post->saveds->first()->pivot->user_id }}</p> --}}
                {{-- every post --}}
                <div class="flex justify-center hover:bg-gray-200 hover:rounded-xl" id="post">
                    <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg">
                        @if ($post->cover)
                            <img class="w-full h-42 sm:h-21 object-cover sm:w-40 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                src="{{ asset('storage/' . $post->cover) }}" alt="" />
                        @else
                            <img class="w-full h-42 sm:h-21 object-cover sm:w-40 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                src="https://source.unsplash.com/200x200/?{{ $post->name }}" alt="" />
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
                            {{-- <p>{{ $post->saveds->first()->pivot->user_id }}</p> --}}
                            {{-- @foreach ($post->saveds as $save) --}}
                            {{-- <p>{{ dd($post->saveds->all()->pivot->user_id) }}</p> --}}
                            {{-- @if (auth()->user()->id == $save->first()->pivot->user_id) --}}
                            {{-- @if (auth()->user()->id == $post->saveds->id) --}}
                            @if (auth()->user()->id == $post->user_id)
                                <a class="text-right py-4 text-blue-600 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                    href="#!" id="saved"><i class="fa fa-bookmark"></i></a>
                            @else
                                <a class="text-right py-4 text-gray-500 text-xl pe-4 md:text-left sm:text-right sm:py-6"
                                    href="#!" id="save"><i class="fa fa-bookmark"></i></a>
                            @endif
                            {{-- @endforeach --}}

                            {{-- scrpit for saved-unsaved button --}}
                            <script type="text/javascript">
                                $(function() {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    // coba buat sendiri
                                    // $save = $("#save");
                                    // $saved = $("#saved");

                                    // if ($save.length) {
                                    //     $save.on('click', function() {
                                    //         $.ajax('SavedController.php', {
                                    //             data: 'here'
                                    //         }, function(response) {
                                    //             // do something with your response from SavedController.php:
                                    //             $save.addClass("unlike");
                                    //             $save.removeClass("like");
                                    //             $saved = $save;
                                    //         });
                                    //     });
                                    // }

                                    // if ($saved.length) {
                                    //     $saved.on('click', function() {
                                    //         $.ajax('SavedController.php', {
                                    //             data: 'here'
                                    //         }, function(response) {
                                    //             // do something with your response from SavedController.php:
                                    //             $saved.addClass("like");
                                    //             $saved.removeClass("unlike");
                                    //             $save = $saved;
                                    //         });
                                    //     });
                                    // }

                                    // contoh ajax dari datatable
                                    $('body').on('click', '#save', function() {
                                        var slug = $(this).data("slug");
                                        $.ajax({
                                            url: "{{ url('savedpost') }}",
                                            type: "POST",
                                            success: function(data) {
                                                table.draw();
                                            },
                                            error: function(data) {
                                                console.log('Error:', data);
                                            }
                                        });
                                    });

                                    $('body').on('click', '#saved', function() {
                                        var id_saved = $(this).data("id_saved");
                                        $.ajax({
                                            url: "{{ url('savedpost') }}" + '/' + id_saved,
                                            type: "DELETE",
                                            success: function(data) {
                                                table.draw();
                                            },
                                            error: function(data) {
                                                console.log('Error:', data);
                                            }
                                        });
                                    });
                                })
                            </script>

                            {{-- tombol edit, only my post --}}
                            @if (auth()->user()->id == $post->user_id)
                                <a class="text-right py-2 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                    href="mypost/{{ $post->slug }}/edit"><i class="fa fa-pencil"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- </div> --}}
    </div>
    {{-- {{ $categories->links() }} --}}
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
