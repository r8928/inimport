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
    {{ $head ?? '' }}
</head>

<body>
    <a href="/" class="d-block display-4 text-primary text-center mb-5">@config('company-name')</a>

    <div class="container">

        {{ $slot }}

    </div>
</body>

</html>
