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
                    <button type="button" class="btn-close text-slate-800 text-lg font-bold" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa fa-x"></i></button>
                </div>
                <form novalidate action="{{ url('user_') }}" role="form" method="POST" enctype="multipart/form-data"
                    id="form_data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mb-2 g-3">
                                <div class="md:grid md:grid-cols-3 md:gap-6 pb-4">
                                    <div class="md:mt-0 md:col-span-2">
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                            <div class="px-4 py-2 pb-2 bg-white space-y-4 sm:p-6">
                                                <div class="col-span-3">
                                                    <label class="block text-sm font-medium text-gray-700"> Photo
                                                    </label>
                                                    <div class="mt-2 flex items-center">
                                                        <span
                                                            class="inline-block h-25 w-25 rounded-full overflow-hidden bg-gray-100">
                                                            @if ($profile->photo)
                                                                <img id="output" class="h-full w-full"
                                                                    src="{{ asset('storage/' . $profile->photo) }}">
                                                            @else
                                                                <img id="output" class="items-align-center img-fluid"
                                                                    src="https://media.istockphoto.com/vectors/default-avatar-profile-icon-vector-vector-id1337144146?b=1&k=20&m=1337144146&s=170667a&w=0&h=ys-RUZbXzQ-FQdLstHeWshI4ViJuEhyEa4AzQNQ0rFI=">
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-span-6 sm:col-span-3 lg:col-span-6">
                                                    <label for="username"
                                                        class="block text-sm font-medium text-gray-700">Username</label>
                                                    <input type="text" readonly name="username" id="username"
                                                        value="{{ $profile->username }}" autocomplete="username"
                                                        class="@error('username') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('username')
                                                        <div class="invalid-feedback ms-4">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-span-3 sm:col-span-3 lg:col-span-2">
                                                    <label for="name"
                                                        class="block text-sm font-medium text-gray-700">Name</label>
                                                    <input type="text" readonly name="name" id="name"
                                                        value="{{ $profile->name }}" autocomplete="name"
                                                        class="@error('name') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('name')
                                                        <div class="invalid-feedback ms-4">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-span-4 sm:col-span-2">
                                                    <label for="email"
                                                        class="block text-sm font-medium text-gray-700">Email
                                                        address</label>
                                                    <input type="text" readonly name="email" id="email"
                                                        value="{{ $profile->email }}" autocomplete="email"
                                                        class="@error('email') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('email')
                                                        <div class="invalid-feedback ms-4">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-span-4 sm:col-span-2">
                                                    <label for="role"
                                                        class="block text-sm font-medium text-gray-700">Role</label>
                                                    <input type="text" readonly name="role" id="role"
                                                        value="" autocomplete="role"
                                                        class="@error('role') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('role')
                                                        <div class="invalid-feedback ms-4">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-span-4 sm:col-span-2">
                                                    <label for="status"
                                                        class="block text-sm font-medium text-gray-700">Status</label>
                                                    <input type="text" readonly name="status" id="status"
                                                        value="" autocomplete="status"
                                                        class="@error('status') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('status')
                                                        <div class="invalid-feedback ms-4">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="act" value="deactivated">
                        <div class="modal-footer">
                            <button type="submit" name="btn_act" value="deactivated"
                                class="bi bi-plus-square btn btn-danger bg-red-600" id="saveBtn"><i
                                    class="fa fa-ghost"></i> deactivate</button>

                            {{-- <button type="submit" name="act" value="active"
                                class="bi bi-plus-square btn btn-success bg-green-600" id="saveBtn"><i
                                    class="fa fa-smile"></i> activate</button> --}}
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
                    {
                        data: 'role',
                        name: 'role',
                        title: 'Role',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Status',
                        searchable: false,
                        orderable: false
                    },
                ],
            });

            // to affect an action with modal
            $('body').on('click', '#manipulateItem', function() {
                var data_id = $(this).data('id');
                $.get("{{ url('user_') }}" + '/' + data_id + '/edit', function(data) {
                    $('#modelHeading').html("User Information");
                    // $('#saveBtn').html("Update");
                    $('#ajaxModel').modal('show');
                    $('#data_id').val(data.id);
                    $('#output').val(data.photo);
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#role').val(data.role);
                    $('#status').val(data.status);
                })
            });

            // submit button after affect data
            $('#saveBtn').click(function(e) {
                var result = confirm("Are you sure?");
                if (result) {
                    e.preventDefault();
                    $(this).html('Sending..');

                    $.ajax({
                        data: $('#form_data').serialize(),
                        url: "{{ url('user_') }}",
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
@endsection
