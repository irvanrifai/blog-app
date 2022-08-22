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
                    <button type="button" class="btn-close text-gray-100 bg-red-700 text-lg font-bold mt-0"
                        data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="md:grid md:grid-cols-3 md:gap-6 pb-4">
                    <div class="md:mt-0 md:col-span-2">
                        <form action="{{ url('profile/' . $profile->username) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700"> Photo </label>
                                        <div class="mt-2 flex items-center">
                                            {{-- script for change photo --}}
                                            <script>
                                                var loadFile = function(event) {
                                                    var output = document.getElementById('output');
                                                    output.src = URL.createObjectURL(event.target.files[0]);
                                                    output.onload = function() {
                                                        URL.revokeObjectURL(output.src) // free memory
                                                    }
                                                };
                                            </script>
                                            <span class="inline-block h-25 w-25 rounded-full overflow-hidden bg-gray-100">
                                                @if ($profile->photo)
                                                    <img id="output" class="h-full w-full"
                                                        src="{{ asset('storage/' . $profile->photo) }}">
                                                @else
                                                    <img id="output" class="items-align-center img-fluid"
                                                        src="https://media.istockphoto.com/vectors/default-avatar-profile-icon-vector-vector-id1337144146?b=1&k=20&m=1337144146&s=170667a&w=0&h=ys-RUZbXzQ-FQdLstHeWshI4ViJuEhyEa4AzQNQ0rFI=">
                                                @endif
                                            </span>
                                            <input type="file" name="photo" id="photo" accept="image/*"
                                                onchange="loadFile(event)" autocomplete="given-name"
                                                class="@error('photo') is-invalid @enderror ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            @error('photo')
                                                <div class="invalid-feedback ms-4">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            {{-- <button type="button"
                                                class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change</button> --}}
                                        </div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-6">
                                        <label for="username"
                                            class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" name="username" id="username"
                                            value="{{ $profile->username }}" autocomplete="username"
                                            class="@error('username') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('username')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-span-3 sm:col-span-3 lg:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $profile->name }}"
                                            autocomplete="name"
                                            class="@error('name') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('name')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email
                                            address</label>
                                        <input type="text" name="email" id="email" value="{{ $profile->email }}"
                                            autocomplete="email"
                                            class="@error('email') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('email')
                                            <div class="invalid-feedback ms-4">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="linkedin_account" class="block text-sm font-medium text-gray-700">
                                                LinkedIn
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                    http:// </span>
                                                <input type="text" name="linkedin_account" id="linkedin_account"
                                                    value="{{ $profile->linkedin_account }}"
                                                    class="@error('linkedin_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    placeholder="https://linkedin.com/">
                                                @error('linkedin_account')
                                                    <div class="invalid-feedback ms-4">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="github_account" class="block text-sm font-medium text-gray-700">
                                                Github
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                    http:// </span>
                                                <input type="text" name="github_account" id="github_account"
                                                    value="{{ $profile->github_account }}"
                                                    class="@error('github_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    placeholder="https://github.com/">
                                                @error('github_account')
                                                    <div class="invalid-feedback ms-4">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="fb_account" class="block text-sm font-medium text-gray-700">
                                                Facebook
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                    http:// </span>
                                                <input type="text" name="fb_account" id="fb_account"
                                                    value="{{ $profile->fb_account }}"
                                                    class="@error('fb_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    placeholder="https://www.facebook.com/">
                                                @error('fb_account')
                                                    <div class="invalid-feedback ms-4">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="ig_account" class="block text-sm font-medium text-gray-700">
                                                Instagram
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                    http:// </span>
                                                <input type="text" name="ig_account" id="ig_account"
                                                    value="{{ $profile->ig_account }}"
                                                    class="@error('ig_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    placeholder="https://www.instagram.com/">
                                                @error('ig_account')
                                                    <div class="invalid-feedback ms-4">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="twt_account" class="block text-sm font-medium text-gray-700">
                                                Twitter
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                    http:// </span>
                                                <input type="text" name="twt_account" id="twt_account"
                                                    value="{{ $profile->twt_account }}"
                                                    class="@error('twt') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    placeholder="https://twitter.com/">
                                                @error('twt_account')
                                                    <div class="invalid-feedback ms-4">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
                <form novalidate action="{{ url('user_') }}" role="form" method="POST"
                    enctype="multipart/form-data" id="form_data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mb-2 g-3">
                                <div class="mb-3 col-md-3 form-group">
                                    <label for="nama" class="form-label">Nama</label><span
                                        class="text-danger">*</span>
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
                    $('#modelHeading').html("User");
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
