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
    <a href="/" class="d-block display-3 text-primary text-center mb-5">OrangeSoft</a>

    <div class="container">

        <div class="mb-3">
            <button class="btn btn-primary" type="button" onclick="javascript:alert('Disabled in DEMO');">
                >> Send All Emails
            </button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Invoice Number</th>
                        <th>Customer</th>
                        <th>Invoice Date</th>
                        <th>Location</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>

                @foreach ($data as $item)
                    <tr>
                        <td><a href="{{ route('invoice.show', $item->invoice_no) }}">{{ $item->invoice_no }}</a></td>
                        <td>{{ $item->customer_name }}</td>
                        <td>{{ $item->invoice_date->toFormattedDateString() }}</td>
                        <td>{{ $item->location }}</td>
                        <td align="right">{{ number_format($item->total, 2) }}</td>
                        <td align="center"><a href="{{ route('invoice.send', $item->invoice_no) }}"><img
                                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBVcGxvYWRlZCB0bzogU1ZHIFJlcG8sIHd3dy5zdmdyZXBvLmNvbSwgR2VuZXJhdG9yOiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIGZpbGw9IiMwMDAwMDAiIGhlaWdodD0iODAwcHgiIHdpZHRoPSI4MDBweCIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiANCgkgdmlld0JveD0iMCAwIDQ5NS4wMDMgNDk1LjAwMyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8ZyBpZD0iWE1MSURfNTFfIj4NCgk8cGF0aCBpZD0iWE1MSURfNTNfIiBkPSJNMTY0LjcxMSw0NTYuNjg3YzAsMi45NjYsMS42NDcsNS42ODYsNC4yNjYsNy4wNzJjMi42MTcsMS4zODUsNS43OTksMS4yMDcsOC4yNDUtMC40NjhsNTUuMDktMzcuNjE2DQoJCWwtNjcuNi0zMi4yMlY0NTYuNjg3eiIvPg0KCTxwYXRoIGlkPSJYTUxJRF81Ml8iIGQ9Ik00OTIuNDMxLDMyLjQ0M2MtMS41MTMtMS4zOTUtMy40NjYtMi4xMjUtNS40NC0yLjEyNWMtMS4xOSwwLTIuMzc3LDAuMjY0LTMuNSwwLjgxNkw3LjkwNSwyNjQuNDIyDQoJCWMtNC44NjEsMi4zODktNy45MzcsNy4zNTMtNy45MDQsMTIuNzgzYzAuMDMzLDUuNDIzLDMuMTYxLDEwLjM1Myw4LjA1NywxMi42ODlsMTI1LjM0Miw1OS43MjRsMjUwLjYyLTIwNS45OUwxNjQuNDU1LDM2NC40MTQNCgkJbDE1Ni4xNDUsNzQuNGMxLjkxOCwwLjkxOSw0LjAxMiwxLjM3Niw2LjA4NCwxLjM3NmMxLjc2OCwwLDMuNTE5LTAuMzIyLDUuMTg2LTAuOTc3YzMuNjM3LTEuNDM4LDYuNTI3LTQuMzE4LDcuOTctNy45NTYNCgkJTDQ5NC40MzYsNDEuMjU3QzQ5NS42NiwzOC4xODgsNDk0Ljg2MiwzNC42NzksNDkyLjQzMSwzMi40NDN6Ii8+DQo8L2c+DQo8L3N2Zz4="
                                    height="16px" /></a></td>
                    </tr>
                @endforeach

            </table>

            <div class="d-flex justify-content-center">
                {!! $data->links() !!}
            </div>
        </div>
    </div>
</body>

</html>
