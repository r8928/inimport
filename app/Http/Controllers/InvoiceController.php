<?php

namespace App\Http\Controllers;

use App\Jobs\InvoiceMail;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = Invoice::where('customer_name', '!=', '')->paginate(50);

        if (!$data->count()) {
            return redirect()->route('home');
        }

        return view('list', compact('data'));
    }

    public function show($invoice_no)
    {
        $data = Invoice::where('invoice_no', $invoice_no)->orderBy('id')->get();

        if (!$data->count()) {
            return redirect()->route('invoice.list');
        }

        $first = $data->first();

        return view('invoice', compact('data', 'first'));
    }

    public function send($invoice_no)
    {
        $data = Invoice::where('invoice_no', $invoice_no)->orderBy('id')->get();

        if (!$data->count()) {
            return redirect()->route('invoice.list');
        }

        InvoiceMail::dispatch($data);

        return back();
    }
}
