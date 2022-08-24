@extends('layouts.main')
@section('container')
    <div class="mt-1 sm:mt-0">
        <div class="ps-4 pb-4 sm:px-0">
            <h3 class="text-lg font-medium leading-0 text-gray-900">{{ $page }}</h3>
        </div>
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-10 md:mt-0 md:col-span-2">
                <form action="{{ url('mypost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-3 sm:col-span-6">
                                    <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                                    {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                    {{-- <img id="output" /> --}}
                                    {{-- script for change cover --}}
                                    <script>
                                        var loadFile = function(event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                    <div class="mt-4 flex items-center">
                                        <span
                                            class="inline-block col-auto overflow-clip h-50 w-60 sm:h-50 sm:w-60 rounded-lg bg-gray-100">
                                            <img id="output" class="items-align-center img-fluid"
                                                src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg">
                                            {{-- <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg> --}}
                                        </span>
                                        {{-- <button type="button"
                                            class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change</button> --}}
                                        <div class="col-auto">
                                            <input type="file" name="cover" id="cover" accept="image/*"
                                                onchange="loadFile(event)" autocomplete="given-name"
                                                class="@error('cover') is-invalid @enderror ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            @error('cover')
                                                <div class="invalid-feedback ms-4">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" autocomplete="given-name"
                                        class="@error('title') is-invalid @enderror mt-2 w-full shadow-md border-gray-700 font-medium py-1.5 sm:text-sm rounded-md"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- slug field --}}
                                {{-- <div class="col-span-6 sm:col-span-3">
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                    <input type="text" name="slug" id="slug" autocomplete="family-name"
                                        class="@error('slug') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}

                                <div class="col-span-3 sm:col-span-2">
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category
                                    </label>
                                    {{-- <input type="" name="category" id="category" autocomplete="category"
                                        class="@error('category') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> --}}
                                    <select
                                        class="mt-2 form-select @error('category') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        id="category" name="category">
                                        <option value="{{ old('category') ? old('category') : '' }}" selected disabled>
                                            <label class="text-gray-400 text-sm">
                                                {{ old('category') ? old('category') : 'Select' }}
                                            </label>
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-6">
                                    <label for="body" class="mb-2 block text-sm font-medium text-gray-700">Body
                                    </label>
                                    <textarea name="body" id="body" class="@error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                                    <script>
                                        ClassicEditor.create(document.querySelector('#body')).catch(error => {
                                            console.error(error);
                                        });
                                        // CKEDITOR.replace('body')
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
                            <div class="text-right">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Post
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
