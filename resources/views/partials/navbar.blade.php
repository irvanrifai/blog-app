<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-gray-800 mb-4">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                @auth
                    <button type="button"
                        class="menus-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @else
                    <a href="{{ url('/') }}"
                        class="{{ Request::is('/*') ? 'bg-gray-900 text-white' : '' }} flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg aria-hidden="true"
                            class="w-7 h-7 mt-1 ms-2 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                        </svg>
                    </a>
                    <a href="{{ url('about') }}"
                        class="{{ Request::is('about') ? 'bg-gray-900 text-white' : '' }} flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 mt-1.5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                    </a>
                @endauth
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    @auth
                        <!-- on mobile view -->
                        <img class="block lg:hidden h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                        <!-- on pc view -->
                        <img class="hidden lg:block h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                            alt="Workflow">
                    @else
                        <img class="h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                            alt="Workflow">
                    @endauth
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        @auth
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{ url('user/post') }}"
                                class="{{ Request::is('user/post') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                aria-current="page">Home</a>

                            <a href="{{ url('user/mypost') }}"
                                class="{{ Request::is('user/mypost') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">My
                                Post</a>

                            <a href="{{ url('user/savedpost') }}"
                                class="{{ Request::is('user/savedpost') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Saved
                            </a>
                            <a href="{{ url('about') }}"
                                class="{{ Request::is('about') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About
                            </a>
                        @else
                            <a href="{{ url('/') }}"
                                class="{{ Request::is('/') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                aria-current="page">Home</a>
                            <a href="{{ url('about') }}"
                                class="{{ Request::is('about') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About
                            </a>
                        @endauth
                        {{-- not used for temp --}}
                        @can('isAdmin')
                            <a href="#"
                                class="{{ Request::is('admin*') ? 'bg-gray-900 text-yellow-500' : '' }} text-yellow-400 hover:bg-gray-700 hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium">Admin</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                {{-- search on web view --}}
                <div class="hidden lg:block flex justify-center mx-3">
                    <div class="xl:w-45">
                        <div class="input-group relative flex flex-wrap items-stretch w-full">
                            <form class="d-flex" action="{{ url('/') }}">
                                <input type="search"
                                    class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-black-600 focus:outline-none"
                                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2"
                                    name="cari" value="{{ request('cari') }}">
                                <button
                                    class="btn inline-block px-6 py-2.5 bg-slate-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-gray-600  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                                    type="submit" id="button-addon2">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search"
                                        class="w-4 border-0" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @guest
                    <a href="{{ url('guest/signin') }}"
                        class="hidden lg:block {{ Request::is('guest/signin') ? 'bg-gray-900 text-white' : '' }} text-gray-200 hover:bg-gray-700 bg-slate-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><i
                            class="fa fa-user"></i> Sign
                        In
                    </a>
                @endguest

                {{-- button signin on mobile view --}}
                @guest
                    <a href="{{ url('guest/signin') }}"
                        class="{{ Request::is('guest/signin') ? 'bg-gray-900 text-white' : '' }} hover:bg-white transition-all duration-150 ease-in-out
                            block lg:hidden input-group-text flex items-center px-3 py-1.5 text-base border-0 font-normal bg-gray-800 text-gray-400 text-center whitespace-nowrap rounded"
                        id="basic-addon2">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                @endguest
                {{-- button search on mobile with modal --}}
                <button type="button" onclick="toggleModal('search')"
                    class="hover:bg-white transition-all duration-150 ease-in-out block lg:hidden input-group-text flex items-center px-3 py-1.5 text-base border-0 font-normal bg-gray-800 text-gray-400 text-center whitespace-nowrap rounded"
                    id="basic-addon2">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-5"
                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                        </path>
                    </svg>
                </button>
                {{-- modal --}}
                <div class="hidden overflow-x-hidden overflow-y-auto fixed-top inset-0 z-50 outline-none focus:outline-none justify-center items-center"
                    id="search">
                    <div class="relative w-auto my-6 mx-auto max-w-3xl">
                        <!--content-->
                        <div
                            class="border-0 mt-20 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                            <!--body-->
                            <div class="input-group relative flex flex-wrap items-stretch w-full">
                                <form class="d-flex" action="{{ url('/') }}">
                                    <input type="search"
                                        class="form-control relative flex-auto min-w-0 block w-full px-6 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-black-600 focus:outline-none"
                                        placeholder="Search" aria-label="Search" aria-describedby="button-addon2"
                                        name="cari" value="{{ request('cari') }}">
                                    <button
                                        class="btn inline-block px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-gray-600  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                                        type="submit" id="button-addon2">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="search" class="w-4 border-0" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <button
                            class="text-blue-600 pt-4 item-align-center text-sm font-bold rounded-full background-transparent outline-none focus:outline-none mr-1 ease-linear transition-all duration-200"
                            type="button" onclick="toggleModal('search')">
                            Cancel
                        </button>
                    </div>
                </div>
                <div class="hidden opacity-30 fixed inset-0 z-20 bg-black" id="search-backdrop"></div>
                <script type="text/javascript">
                    function toggleModal(modalID) {
                        document.getElementById(modalID).classList.toggle("hidden");
                        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
                        document.getElementById(modalID).classList.toggle("flex");
                        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
                    }
                </script>
                @auth
                    <button type="button"
                        class="notif-button bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <div class="hidden isi-notif origin-top-right absolute right-0 mt-2 w-72 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <p class="text-gray-700">notifikasi</p>
                            <p class="text-red-600">dalam</p>
                            <p class="text-blue-600">wacana</p>
                        </div>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button type="button"
                                class="user-menu-button bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                @if (auth()->user()->photo)
                                    <img class="h-8 w-8 rounded-full" {{-- src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" --}}
                                        src="{{ asset('storage/' . auth()->user()->photo) }}" alt="">
                                @else
                                    <img class="h-8 w-8 rounded-full" {{-- src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" --}}
                                        src="https://source.unsplash.com/100x100/?avatar" alt="">
                                @endif
                            </button>
                        </div>
                        <div class="hidden user-menu-item origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <p class="block px-4 py-2 text-lg text-gray-200 bg-gray-600 rounded" role="menuitem"
                                tabindex="-1" id="user-name">{{ Str::of(auth()->user()->name)->words(2, '') }}</p>
                            <a href="{{ url('user/profile') }}"
                                class="{{ Request::is('user/profile') ? 'text-blue-500 rounded' : '' }} block px-4 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</a>
                            <a href="{{ url('user/setting') }}"
                                class="{{ Request::is('user/setting') ? 'text-blue-500 rounded' : '' }} block px-4 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <form action="{{ url('/signout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:text-blue-500"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden menus-item" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            @auth
                <a href="{{ url('user/post') }}"
                    class="{{ Request::is('user/post*') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                    aria-current="page">Home</a>

                <a href="{{ url('user/mypost') }}"
                    class="{{ Request::is('user/mypost') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">My
                    Post</a>

                <a href="{{ url('user/savedpost') }}"
                    class="{{ Request::is('user/savedpost') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Saved
                </a>
                <a href="{{ url('about') }}"
                    class="{{ Request::is('about') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About
                </a>
            @else
                <a href="{{ url('/') }}"
                    class="{{ Request::is('/*') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                    aria-current="page">Home</a>
                <a href="{{ url('about') }}"
                    class="{{ Request::is('about') ? 'bg-gray-900 text-white' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About
                </a>
            @endauth
            {{-- @can('isAdmin')
                <a href="#"
                    class="{{ Request::is('admin') ? 'bg-gray-900 text-yellow-500' : '' }} text-yellow-400 hover:bg-gray-700 hover:text-yellow-500 px-3 py-2 rounded-md text-base font-medium">Admin</a>
            @endcan --}}
        </div>
    </div>
</nav>
<script>
    // script for avatar dropdown
    const btn = document.querySelector("button.user-menu-button");
    const menu = document.querySelector(".user-menu-item");
    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    // script for menu dropdown
    const button = document.querySelector("button.menus-button");
    const menus = document.querySelector(".menus-item");
    button.addEventListener("click", () => {
        menus.classList.toggle("hidden");
    });

    // script for notification
    const n_button = document.querySelector("button.notif-button");
    const isi = document.querySelector(".isi-notif");
    n_button.addEventListener("click", () => {
        isi.classList.toggle("hidden");
    });
</script>
