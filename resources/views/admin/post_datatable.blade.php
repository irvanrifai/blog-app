@extends('layouts.main')
@section('container')
    <h1 class="text-2xl mb-4">{{ $page }}</h1>
    <div class="table-responsive">
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
                        data: 'category_id',
                        name: 'category_id',
                        title: 'Category',
                    },
                    {
                        data: 'body',
                        name: 'body',
                        title: 'Body',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Created at',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        title: 'Updated at',
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
            $('body').on('click', '#editItem', function() {
                var data_id = $(this).data('id');
                $.get("{{ url('post_') }}" + '/' + data_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Item");
                    $('#saveBtn').html("Update");
                    $('#ajaxModel').modal('show');
                    $('#data_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#alamat').val(data.alamat);
                })
            });

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
    </script>


    <script>
        $(document).ready(function() {
            var table = $('#tb_datatable').DataTable();

            $('#tb_datatable tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });

            $('#button').click(function() {
                alert(table.rows('.selected').data().length + ' row(s) selected');
            });
        });
    </script>
@endsection
