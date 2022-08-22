@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <a type="button" href="javascript:void(0)" class="btn btn-primary my-3 btn-sm bg-blue-500" id="createCategory"><i
            class="fa fa-plus"></i>
        Add category
    </a>
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
                    url: '{{ url('category_') }}',
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        title: 'ID Category',
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: 'Name',
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

            // button to add new category
            $('#createCategory').click(function() {
                $('#saveBtn').html("Add");
                $('#data_id').val('');
                $('#form_data').trigger("reset");
                $('#modelHeading').html("Create New Data");
                $('#ajaxModel').modal('show');
            });

            // to affect an action with modal
            $('body').on('click', '#editItem', function() {
                var data_id = $(this).data('id');
                $.get("{{ url('category_') }}" + '/' + data_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Item");
                    $('#saveBtn').html("Update");
                    $('#ajaxModel').modal('show');
                    $('#data_id').val(data.id);
                    $('#name').val(data.name);
                })
            });

            // submit button after affect data
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#form_data').serialize(),
                    url: "{{ url('category_') }}",
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

            // button to delete item
            $('body').on('click', '#deleteItem', function() {

                var data_id = $(this).data("id");
                var result = confirm("Are You sure want to delete?");

                if (result) {
                    $.ajax({
                        url: "{{ url('category_') }}" + '/' + data_id,
                        type: "delete",
                        data: {
                            id: data_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else {
                    return false;
                }
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

    {{-- modal for action --}}
    <div class="modal fade" id="ajaxModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
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
                                <div class="mb-3 col-md-6 form-group">
                                    <label for="name" class="form-label">Category Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="Category" required
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="bi bi-plus-square btn btn-primary bg-blue-500" id="saveBtn"
                            value="create"><i class="fa fa-plus"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
