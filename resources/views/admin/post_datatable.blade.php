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
                    <button type="button" class="btn-close text-slate-800 text-lg font-bold" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa fa-x"></i></button>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-6">
                    <div class="mt-10 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-3 sm:col-span-6">
                                        <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
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
                                                @if (1 == 2)
                                                    <img id="output" class="items-align-center img-fluid"
                                                        src="{{ asset('storage/') }}">
                                                @else
                                                    <img id="output" class="items-align-center img-fluid"
                                                        src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg">
                                                @endif
                                            </span>
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

                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="category" class="block text-sm font-medium text-gray-700">Category
                                        </label>
                                        <select
                                            class="mt-2 form-select @error('category') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="category" name="category">
                                            <option value="{{ old('category') }}" selected>
                                                <label class="text-gray-400 text-sm">
                                                    {{ old('category') }}
                                                </label>
                                            </option>
                                            {{-- @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach --}}
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
                                        <textarea name="body" id="body" value="{{ old('body') }}" class="@error('body') is-invalid @enderror">{!! old('body') !!}</textarea>
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
                                    <form action="{{ url('mypost/') }}" method="post">
                                        @csrf
                                        @method('delete')
                                        @if (1 == 1)
                                            <button type="submit" class="bi bi-plus-square btn btn-danger bg-red-600"
                                                id="saveBtn" value="create"><i class="fa fa-ghost"></i> takedown</button>
                                        @else
                                            <button type="submit" class="bi bi-plus-square btn btn-success bg-green-600"
                                                id="saveBtn" value="create"><i class="fa fa-smile"></i> restore</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
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
                            $('#modelHeading').html("Post Information");
                            // $('#saveBtn').html("Update");
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
