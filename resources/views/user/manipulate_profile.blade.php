@extends('layouts.main')
@section('container')
    <div>
        <div class="md:grid md:grid-cols-3 md:gap-6 pb-4">
            <div class="md:mt-0 md:col-span-2">
                <form action="{{ url('user/profile/' . $profile->username) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700"> Photo </label>
                                <div class="mt-2 flex items-center">
                                    {{-- script for change photo --}}
                                    <script>
                                        var loadFile = function(event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                    <span class="inline-block h-25 w-25 rounded-full overflow-hidden bg-gray-100">
                                        @if ($profile->photo)
                                            <img id="output" class="h-full w-full"
                                                src="{{ asset('storage/' . $profile->photo) }}">
                                        @else
                                            <img id="output" class="items-align-center img-fluid"
                                                src="https://media.istockphoto.com/vectors/default-avatar-profile-icon-vector-vector-id1337144146?b=1&k=20&m=1337144146&s=170667a&w=0&h=ys-RUZbXzQ-FQdLstHeWshI4ViJuEhyEa4AzQNQ0rFI=">
                                        @endif
                                    </span>
                                    <input type="file" name="photo" id="photo" accept="image/*"
                                        onchange="loadFile(event)" autocomplete="given-name"
                                        class="@error('photo') is-invalid @enderror ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    @error('photo')
                                        <div class="invalid-feedback ms-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{-- <button type="button"
                                        class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change</button> --}}
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-6">
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" value="{{ $profile->username }}"
                                    autocomplete="username"
                                    class="@error('username') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('username')
                                    <div class="invalid-feedback ms-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-3 sm:col-span-3 lg:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ $profile->name }}"
                                    autocomplete="name"
                                    class="@error('name') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('name')
                                    <div class="invalid-feedback ms-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-4 sm:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email
                                    address</label>
                                <input type="text" name="email" id="email" value="{{ $profile->email }}"
                                    autocomplete="email"
                                    class="@error('email') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('email')
                                    <div class="invalid-feedback ms-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="linkedin_account" class="block text-sm font-medium text-gray-700"> LinkedIn
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            http:// </span>
                                        <input type="text" name="linkedin_account" id="linkedin_account"
                                            value="{{ $profile->linkedin_account }}"
                                            class="@error('linkedin_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                            placeholder="https://linkedin.com/">
                                        @error('linkedin_account')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="github_account" class="block text-sm font-medium text-gray-700"> Github
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            http:// </span>
                                        <input type="text" name="github_account" id="github_account"
                                            value="{{ $profile->github_account }}"
                                            class="@error('github_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                            placeholder="https://github.com/">
                                        @error('github_account')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="fb_account" class="block text-sm font-medium text-gray-700"> Facebook
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            http:// </span>
                                        <input type="text" name="fb_account" id="fb_account"
                                            value="{{ $profile->fb_account }}"
                                            class="@error('fb_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                            placeholder="https://www.facebook.com/">
                                        @error('fb_account')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="ig_account" class="block text-sm font-medium text-gray-700"> Instagram
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            http:// </span>
                                        <input type="text" name="ig_account" id="ig_account"
                                            value="{{ $profile->ig_account }}"
                                            class="@error('ig_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                            placeholder="https://www.instagram.com/">
                                        @error('ig_account')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="twt_account" class="block text-sm font-medium text-gray-700"> Twitter
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            http:// </span>
                                        <input type="text" name="twt_account" id="twt_account"
                                            value="{{ $profile->twt_account }}"
                                            class="@error('twt') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                            placeholder="https://twitter.com/">
                                        @error('twt_account')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
