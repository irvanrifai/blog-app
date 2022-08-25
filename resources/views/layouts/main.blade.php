<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="icon" href="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" type="image/x-icon">

    {{-- my css and js --}}
    <link rel="stylesheet" href="{{ '/css/app.css' }}">
    <script type="text/javascript" src="{{ '/js/app.js' }}"></script>

    {{-- tailwind css CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- bootstrap css and js --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script> --}}

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/8186c4a2d4.js" crossorigin="anonymous"></script>

    {{-- ckeditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <div id="editor"></div> --}}


    {{-- datatable --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    {{-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
        function preview_img() {
            const gambar = document.querySelector('#foto');
            // const gambar_label = document.querySelector('.custom-file-label');
            const img_preview = document.querySelector('.img-preview');

            // gambar_label.textContent = gambar.files[0].name;

            const file_gambar = new FileReader();
            file_gambar.readAsDataURL(gambar.files[0]);

            file_gambar.onload = function(e) {
                img_preview.src = e.target.result;
            }
        }
    </script>

    <title>{{ $title }}</title>
</head>

<body>
    @can('isAdmin')
        <div class="row px-2 py-4">
            @include('sweetalert::alert')
            <div class="col">
                <div class="container">
                    @include('partials.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="container">
                    @yield('container')
                </div>
            </div>
        </div>
    @else
        @include('partials.navbar')
        @include('sweetalert::alert')
        <div class="container px-4 py-4">
            <div class="col">
                @yield('container')
            </div>
        </div>
        @include('partials.footer')
    @endcan
</body>

</html>
