@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-md-5">
            <div
                class="w-full max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 py-4">
                    {{-- <button id="dropdownButton" data-dropdown-toggle="dropdown"
                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                </svg>
            </button> --}}
                    <!-- Dropdown menu -->
                    {{-- <div id="dropdown"
                class="z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 block"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(446px, 83px);">
                <ul class="py-1" aria-labelledby="dropdownButton">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export
                            Data</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                    </li>
                </ul>
            </div> --}}
                </div>
                <div class="flex flex-col items-center pb-10">
                    @if ($users->photo)
                        <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{ asset('storage/' . $users->photo) }}"
                            alt="Bonnie image">
                    @else
                        <img class="mb-3 w-24 h-24 rounded-full shadow-lg"
                            src="https://media.istockphoto.com/vectors/default-avatar-profile-icon-vector-vector-id1337144146?b=1&k=20&m=1337144146&s=170667a&w=0&h=ys-RUZbXzQ-FQdLstHeWshI4ViJuEhyEa4AzQNQ0rFI="
                            alt="Bonnie image">
                    @endif
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $users->name }}</h5>
                    <span class="text-sm text-gray-500 pb-4 dark:text-gray-400">{{ $users->username }}</span>
                    <div class="flex mt-4 space-x-3 md:mt-8">
                        <div class="flex justify-center mb-4">
                            <a href="{{ $users->fb_account ? $users->fb_account : '#!' }}" class="mr-9 text-gray-800">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f"
                                    class="svg-inline--fa fa-facebook-f w-2.5" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{ auth()->user()->twt_account ? auth()->user()->twt_account : '#!' }}"
                                class="mr-9 text-gray-800">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter"
                                    class="svg-inline--fa fa-twitter w-4" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{ auth()->user()->ig_account ? auth()->user()->ig_account : '#!' }}"
                                class="mr-9 text-gray-800">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram"
                                    class="svg-inline--fa fa-instagram w-3.5" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{ auth()->user()->linkedin_account ? auth()->user()->linkedin_account : '#!' }}"
                                class="mr-9 text-gray-800">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in"
                                    class="svg-inline--fa fa-linkedin-in w-3.5" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{ auth()->user()->github_account ? auth()->user()->github_account : '#!' }}"
                                class="text-gray-800">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github"
                                    class="svg-inline--fa fa-github w-4" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 496 512">
                                    <path fill="currentColor"
                                        d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-group" id="posts">
                <div class="row row-cols-md-2 g-4 mx-3 my-4">
                    @forelse ($users as $user)
                        {{-- <p>{{ $user->saveds->first()->pivot->user_id }}</p> --}}
                        {{-- every post --}}
                        <div class="flex justify-center hover:bg-gray-200 hover:rounded-xl" id="post">
                            <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg">
                                @if ($user->cover)
                                    <img class="w-full h-42 sm:h-21 object-cover sm:w-40 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                        src="{{ asset('storage/' . $user->cover) }}" alt="" />
                                @else
                                    <img class="w-full h-42 sm:h-21 object-cover sm:w-40 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                        src="https://source.unsplash.com/200x200/?{{ $user->category->name }}"
                                        alt="" />
                                @endif
                                <div class="p-6 flex flex-col justify-start">
                                    <a href="{{ url('user/mypost' . '/' . $user->slug) }}">
                                        {{-- <a href="{{ url('user/post') }}"> --}}
                                        <h5 class="text-gray-900 hover:text-blue-700 text-xl font-medium mb-2">
                                            {{ Str::of($user->title)->words(10, '') }}
                                        </h5>
                                    </a>
                                    <p class="text-gray-700 text-justify text-base mb-2">
                                        {!! Str::of($user->body)->words(20, ' read more...') !!}
                                    </p>
                                    <p class="text-gray-800 text-xs mt-2">In Category :
                                        <a
                                            href="{{ url('user/category') . '/' . $user->category->id }}">{{ $user->category->name }}</a>
                                    </p>
                                    <p class="text-gray-900 text-sm my-2 font-bold">By
                                        <a
                                            href="{{ url('user/profile') . '/' . $user->user->username }}">{{ Str::of($user->user->name)->words(3, '') }}</a>
                                    </p>
                                    <p class="text-gray-600 text-xs mt-2">Last update on
                                        {{ $user->updated_at->diffForHumans() }}
                                        {{-- {{ $user->saveds->user_id }} --}}
                                    </p>
                                </div>

                                {{-- kasih kondisi saved/not saved --}}
                                {{-- masih error, entah relationship atau apanya --}}
                                <div class="flex px-4">
                                    {{-- <p>{{ $user->saveds->first()->pivot->user_id }}</p> --}}
                                    {{-- @foreach ($user->saveds as $save) --}}
                                    {{-- <p>{{ dd($user->saveds->all()->pivot->user_id) }}</p> --}}
                                    {{-- @if (auth()->user()->id == $save->first()->pivot->user_id) --}}
                                    {{-- @if (auth()->user()->id == $user->saveds->id) --}}
                                    @if (auth()->user()->id == $user->user->id)
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
                                    @if (auth()->user()->id == $user->user_id)
                                        <a class="text-right py-2 text-gray-500 text-xl pt-4 pe-4 md:text-left sm:text-right sm:py-6"
                                            href="mypost/{{ $user->slug }}/edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-8">
                            <h1 class="text-gray-700 text-2xl font-bold">Hello, {{ auth()->user()->name }}!</h1>
                            <h1 class="text-gray-800 text-xl font-bold">Get your first post!</h1>
                            <div class="text-center sm:px-14 py-14 px-10">
                                <a class="text-gray-600 px-4 py-3 bg-gray-300 shadow-xl text-xl hover:text-2xl font-bold rounded-full mr-1 ease-linear"
                                    href="{{ url('mypost/create') }}"><i class="fa fa-plus"></i>
                                </a>
                                <i>click now!</i>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{-- </div> --}}
            </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
