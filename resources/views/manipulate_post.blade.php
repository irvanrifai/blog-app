@extends('layouts.main')
@section('container')
    <div class="mt-1 sm:mt-0">
        <div class="ps-4 pb-4 sm:px-0">
            <h3 class="text-lg font-medium leading-0 text-gray-900">Edit Post</h3>
        </div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-10 md:mt-0 md:col-span-2">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                                    <div class="mt-2 flex items-center">
                                        <span class="inline-block h-24 w-24 rounded-full overflow-hidden bg-gray-100">
                                            <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </span>
                                        <button type="button"
                                            class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change</button>
                                    </div>
                                    <input type="file" name="cover" id="cover" autocomplete="given-name"
                                        class="@error('cover') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('cover')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" autocomplete="given-name"
                                        class="@error('title') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                    <input type="text" name="slug" id="slug" autocomplete="family-name"
                                        class="@error('slug') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category
                                        address</label>
                                    <input type="text" name="category" id="category" autocomplete="category"
                                        class="@error('category') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="body" class="block text-sm font-medium text-gray-700">Body
                                    </label>
                                    <input name="body" type="text" id="body"
                                        class="@error('body') is-invalid @enderror">
                                    <script>
                                        ClassicEditor.create(document.querySelector('#body')).catch(error => {
                                            console.error(error);
                                        });
                                    </script>
                                    @error('body')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6">
                            <div class="text-left">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update
                                    Now</button>
                            </div>
                            <div class="text-right">
                                <a type="button" href="#"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"><i
                                        class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
