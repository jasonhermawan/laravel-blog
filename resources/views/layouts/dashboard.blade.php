<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <style type="text/css">
        .ck-editor__editable_inline
        {
            min-height: 300px;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-nowrap">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Content --}}
        <div class="py-5 w-100 px-5" style="margin-left: 300px;">
            @yield('content')
        </div>
    </div>

    {{-- Bootstrap JS Bundle (popper.js included) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- CK EDITOR RTE --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>
