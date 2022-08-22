@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <div class="table-responsive pt-2">
        <table id="tb_datatable" class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- modal for action --}}
    <div class="modal fade" id="ajaxModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-6">
                    <div class="mt-10 md:mt-0 md:col-span-2">
                        <form action="{{ url('mypost/' . $posts->slug) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-3 sm:col-span-6">
                                            <label for="cover"
                                                class="block text-sm font-medium text-gray-700">Cover</label>
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
                                                    @if ($posts->cover)
                                                        <img id="output" class="items-align-center img-fluid"
                                                            src="{{ asset('storage/' . $posts->cover) }}">
                                                    @else
                                                        <img id="output" class="items-align-center img-fluid"
                                                            src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg">
                                                    @endif
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
                                            <label for="title"
                                                class="block text-sm font-medium text-gray-700">Title</label>
                                            <input type="text" name="title" id="title" autocomplete="given-name"
                                                class="@error('title') is-invalid @enderror mt-2 w-full shadow-md border-gray-700 font-medium py-1.5 sm:text-sm rounded-md"
                                                value="{{ old('title', $posts->title) }}">
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
                                                <option value="{{ old('category', $posts->category->id) }}" selected>
                                                    <label class="text-gray-400 text-sm">
                                                        {{ old('category', $posts->category->name) }}
                                                    </label>
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
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
                                            <textarea name="body" id="body" value="{{ old('body', $posts->body) }}"
                                                class="@error('body') is-invalid @enderror">{!! old('body', $posts->body) !!}</textarea>
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
                                    <div class="text-left">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update
                                            Now</button>
                                    </div>
                        </form>
                        <div class="text-right">
                            <form action="{{ url('mypost/' . $posts->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Delete this post?')"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <form novalidate action="{{ url('post_') }}" role="form" method="POST" enctype="multipart/form-data"
                    id="form_data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mb-2 g-3">
                                <div class="mb-3 col-md-3 form-group">
                                    <label for="title" class="form-label">Title</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" placeholder="title" required
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4 form-group">
                                    <label for="category" class="form-label">Category</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                        name="category" id="category" placeholder="category tambahan" required
                                        value="{{ old('category') }}">
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4 form-group">
                                    <label for="body" class="form-label">Body</label><span
                                        class="text-danger">*</span>
                                    <textarea type="textarea" class="form-control @error('body') is-invalid @enderror" name="body" id="body"
                                        placeholder="body tambahan" required value="{{ old('body') }}"></textarea>
                                    @error('body')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4 form-group">
                                    <label for="status" class="block text-sm font-medium text-gray-700">status
                                    </label>
                                    <select
                                        class="mt-2 form-select @error('status') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        id="status" name="status">
                                        <option value="{{ old('status') }}" id="status" name="status" selected>
                                            <label class="text-gray-400 text-sm">
                                                {{ old('status') }}
                                            </label>
                                        </option>
                                        <option value="{{ null }}">{{ 'restore' }}</option>
                                        <option value="{{ 1 }}">{{ 'takedown' }}</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="bi bi-plus-square btn btn-primary" id="saveBtn"
                            value="create"><i class="fa fa-plus"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // to view/read data
            var table = $('#tb_datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ url('post_') }}',
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'title',
                        name: 'title',
                        title: 'Title',
                    },
                    {
                        data: 'category.name',
                        name: 'category',
                        title: 'Category',
                    },
                    {
                        data: 'body',
                        name: 'body',
                        title: 'Body',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Action',
                        searchable: false,
                        orderable: false
                    },
                ],
            });

            // to affect an action with modal
            $('body').on('click', '#manipulateItem', function() {
                var data_id = $(this).data('id');
                $.get("{{ url('post_') }}" + '/' + data_id + '/edit', function(data) {
                    $('#modelHeading').html("Post");
                    $('#saveBtn').html("Update");
                    $('#ajaxModel').modal('show');
                    $('#data_id').val(data.id);
                    $('#title').val(data.title);
                    $('#category').val(data.category);
                    $('#body').val(data.body);
                    $('#status').val(data.status);
                })
            });

            // submit button after affect data
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#form_data').serialize(),
                    url: "{{ url('post_') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#form_data').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });
        });

        // for table can selected row
        $(document).ready(function() {
            var table = $('#tb_datatable').DataTable();

            $('#tb_datatable tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            // button for inform amount of table selected (not used)
            $('#button').click(function() {
                alert(table.rows('.selected').data().length + ' row(s) selected');
            });
        });
    </script>
@endsection
