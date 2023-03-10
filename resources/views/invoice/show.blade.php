<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $first->invoice_no }} | @config('application-title')</title>

    <style>
        .display-4,
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        html,
        body {
            font-size: 16px;
            width: 100%;
            margin: auto;
            {{ !app()->runningInConsole() ? 'width : 800px' : '' }}
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            line-height: 1
        }

        h3 {
            font-size: 1.3rem;
            color: #F81D2D;
        }

        h5 {
            font-size: 1rem;
        }

        .text-muted {
            color: #6c757d;
        }

        tr.border th,
        tr.border td {
            border-bottom: 1px solid silver;
        }

        tr.border>th {
            border-top: 1px solid silver;
        }

        th,
        td {
            word-break: break-word;
        }

        .display-4 {
            font-size: 3rem;
            font-weight: 300;
            line-height: 1.2;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <table border=0 cellpadding=10 width="100%">
        <tr>
            <td>
                <table border=0 width="100%">
                    <tr>
                        <td width="33.33%">
                            <img class="img" alt="Invoce Template"
                                src="https://cdn-icons-png.flaticon.com/512/2474/2474482.png" height="100px" />
                        </td>
                        <td width="33.33%" align="center">
                            <div class="display-4" style="font-family: sans-serif">INVOICE</div>
                            <h5>{{ $first->invoice_no }}</h5>
                        </td>
                        <td width="33.33%" align="right">
                            <h3>@config('company-name')</h3>
                            <div>@config('company-address')</div>
                            <div>@config('company-phone')</div>
                            <div>@config('company-email')</div>
                        </td>
                    </tr>
                </table>

                <br />
                <br />
                <br />

                <table border=0 width="100%">
                    <tr>
                        <td width="33.33%">
                            <h5 class="mb-0">{{ $first->customer_name }}</h5>
                            {{ $first->email }}
                        </td>

                        <td width="33.33%" align="right">
                            <div>
                                <em class="text-muted">Bill date</em>
                                {{ $first->invoice_date->toFormattedDateString() }}
                            </div>
                            <div>
                                <em class="text-muted">Due date</em>
                                {{ $first->due_date->toFormattedDateString() }}
                            </div>
                        </td>
                    </tr>
                </table>

                <br />
                <br />

                <table width="100%" cellpadding="15" border="0" cellspacing="0">
                    <thead>
                        <tr class="border">
                            <th width=60% align="left">Description</th>
                            <th align="right">Qty</th>
                            <th align="right">Rate</th>
                            <th align="right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="border">
                                <td class="col-6">{{ $item->product_service }}</td>
                                <td align="right">{{ number_format($item->qty, 2) }}</td>
                                <td align="right">{{ number_format($item->rate, 2) }}</td>
                                <td align="right">{{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" align="right">
                                <p style="font-weight: bold;">Shipment and Taxes:</p>
                                <p style="font-weight: bold;">Total Amount:</p>
                                <p style="font-weight: bold;">Discount:</p>
                            </td>
                            <td>
                                <p style="font-weight: bold; text-align:right;">
                                    {{ number_format($tax = $first->total * $first->tax_rate, 2) }}</p>
                                <p style="font-weight: bold; text-align:right;"></p>
                                <p style="font-weight: bold; text-align:right;">
                                    {{ number_format($tax + $first->total, 2) }}</p>
                                <p style="font-weight: bold; text-align:right;">0.00</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">
                                <h3>Total:</h3>
                            </td>
                            <td align="right">
                                <h3>{{ number_format($tax + $first->total, 2) }}</h3>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </td>
        </tr>
    </table>

</body>
