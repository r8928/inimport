<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice to Email | OrangeSoft</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div style="min-width: 100vw;min-height: 100vh;" class="d-flex justify-content-center align-items-center flex-column">

        <div class="display-3 text-primary text-center" style=" z-index: 1; margin-bottom: -10px; ">OrangeSoft</div>
        <form method="POST" style="width: 500px" class="border rounded px-3 py-5" enctype="multipart/form-data">
            @csrf

            <label>Import CSV</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="file" required accept=".csv">
                <label class="custom-file-label" for="customFile">Choose file</label>
                <div class="small text-danger">DEMO: Only 5kb file allowed</div>
            </div>

            <x-errors></x-errors>

            <div class="mt-3 text-center">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>

    </div>
</body>

</html>
