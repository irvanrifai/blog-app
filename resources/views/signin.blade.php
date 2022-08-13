@extends('layouts.main')
@section('container')
    <div class="mt-1 sm:mt-0">
        <div class="ps-4 mb-4 sm:px-0">
            <h3 class="text-lg font-medium leading-0 text-gray-900">Sign in</h3>
        </div>
        <div class="md:grid md:grid-cols-3 md:gap-96">
            <div class="mt-10 md:mt-0 md:col-span-2">
                <form action="/signin" method="POST">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-4 sm:col-span-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        address</label>
                                    <input type="text" name="email" id="email" autocomplete="email"
                                        class="@error('email') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-span-4 sm:col-span-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="password" id="password" autocomplete="family-name"
                                        class="@error('password') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6">
                            <div class="text-left">
                                <p class="text-sm text-gray-600">Don't have account?
                                </p>
                                <a href="/signup" class="text-sm text-blue-600">Sign up</a>
                            </div>
                            <div class="text-right">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign
                                    in</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-20 w-20 object-cover sm:h-30 md:h-30 lg:w-40 lg:h-40"
                src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="">
        </div> --}}
    </div>
@endsection
