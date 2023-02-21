<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice to Email</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div style="min-width: 100vw;min-height: 100vh;" class="d-flex justify-content-center align-items-center">

        <div style="width: 500px" class="border rounded px-3 py-5">
            <div class="display-3 text-primary text-center">OrangeSoft</div>

            <label>Import CSV</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

        </div>

    </div>
</body>

</html>