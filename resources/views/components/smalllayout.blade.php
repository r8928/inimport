<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | ' : '' }} @config('application-title')</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    <div style="min-width: 100vw;min-height: 100vh;"
        class="d-flex justify-content-center align-items-center flex-column px-3">

        <div class="display-4 text-primary text-center" style=" z-index: 1; margin-bottom: -10px; ">@config('company-name')
        </div>
        <form method="POST" class="col-12 col-sm-6 col-md-4 border rounded px-3 py-5" enctype="multipart/form-data">
            @csrf

            {{ $slot }}

        </form>
    </div>
</body>

</html>
