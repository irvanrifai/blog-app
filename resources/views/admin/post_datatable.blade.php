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
                <form novalidate action="{{ url('post_') }}" role="form" method="POST" enctype="multipart/form-data"
                    id="form_data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mb-2 g-3">
                                <div class="mb-3 col-md-3 form-group">
                                    <label for="title" class="form-label">Title</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" placeholder="title lengkap" required
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
                                    <label for="body" class="form-label">Body</label><span class="text-danger">*</span>
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
                        <button type="submit" class="bi bi-plus-square btn btn-primary" id="saveBtn" value="create"><i
                                class="fa fa-plus"></i> </button>
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
