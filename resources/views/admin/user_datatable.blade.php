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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form novalidate action="{{ url('user_') }}" role="form" method="POST" enctype="multipart/form-data"
                    id="form_data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mb-2 g-3">
                                <div class="mb-3 col-md-3 form-group">
                                    <label for="nama" class="form-label">Nama</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" id="nama" placeholder="Nama lengkap" required
                                        value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-3 form-group">
                                    <label for="tgl_lahir" class="form-label">Tanggal lahir</label><span
                                        class="text-danger">*</span>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                        name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4 form-group">
                                    <label for="alamat" class="form-label">Alamat</label><span
                                        class="text-danger">*</span>
                                    <textarea type="textarea" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                        placeholder="Alamat tambahan" required value="{{ old('alamat') }}"></textarea>
                                    @error('alamat')
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
                    url: '{{ url('user_') }}',
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: 'Name',
                    },
                    {
                        data: 'username',
                        name: 'username',
                        title: 'Username',
                    },
                    {
                        data: 'email',
                        name: 'email',
                        title: 'Email',
                    },
                    // {
                    //     data: 'role',
                    //     name: 'role',
                    //     title: 'Role',
                    // },
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
                $.get("{{ url('user_') }}" + '/' + data_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Item");
                    $('#saveBtn').html("Update");
                    $('#ajaxModel').modal('show');
                    $('#data_id').val(data.id);
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#role').val(data.role);
                    $('#status').val(data.status);
                })
            });

            // submit button after affect data
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#form_data').serialize(),
                    url: "{{ url('PenggunaController') }}",
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
