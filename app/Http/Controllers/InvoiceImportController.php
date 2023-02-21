<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class InvoiceImportController extends Controller
{
    public function __invoke()
    {
        request()->validate(['file' => 'required|file|mimes:txt,csv|min:1']);

        $file = request()->file('file');

        if ($file->getSize() > 5000) {
            throw ValidationException::withMessages(['DEMO SOFTWARE: Cannot import large files']);
        }

        $tmpFilePath = tempnam(sys_get_temp_dir(), 'uploaded-file-');
        $file->move(sys_get_temp_dir(), $tmpFilePath);

        $tmpFilePath = $this->fixlocalpathslashes($tmpFilePath);
        $this->csvFixLineTerminator($tmpFilePath);

        $query = 'SET GLOBAL local_infile=1;';
        \DB::unprepared($query);

        $query = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_invoices LIKE invoices';
        \DB::unprepared($query);

        $query = 'ALTER TABLE temp_invoices
        CHANGE invoice_date invoice_date VARCHAR(255) NULL DEFAULT NULL,
        CHANGE due_date due_date VARCHAR(255) NULL DEFAULT NULL';
        \DB::unprepared($query);

        $query = "LOAD DATA LOCAL INFILE '" . $tmpFilePath . "'
        INTO TABLE `temp_invoices`
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"'
        LINES TERMINATED BY '\n'
        IGNORE 1 LINES
        (`invoice_no`, `customer_name`, `email`, `terms`, `invoice_date`, `due_date`, `location`, `memo`, `message_on_invoice`, @dummy, `product_service`, `description`, `qty`, `rate`, `amount`, `tax_rate`)
        SET created_at=CURRENT_TIMESTAMP
        ";
        \DB::unprepared($query);

        $query = "DELETE FROM `temp_invoices` WHERE product_service = ''";
        \DB::unprepared($query);

        try {
            $query = "UPDATE `temp_invoices` SET
                invoice_date=STR_TO_DATE(invoice_date, '%d/%m/%Y'),
                due_date=STR_TO_DATE(due_date, '%d/%m/%Y')
                WHERE invoice_date != ''";
            \DB::unprepared($query);
        } catch (\Throwable $th) {
            ValidationException::withMessages(['Bad dates given not in %d/%m/%Y format']);
        }

        $query = "UPDATE `temp_invoices` SET
            invoice_date=NULL,
            due_date=NULL
            WHERE invoice_date = ''";
        \DB::unprepared($query);

        $invoices = \DB::table('temp_invoices')
            ->selectRaw('invoice_no, SUM(amount) as total')
            ->groupBy('invoice_no')
            ->get();
        foreach ($invoices as $invoice) {
            \DB::table('temp_invoices')
                ->where('invoice_no', $invoice->invoice_no)
                ->where('product_service', '!=', '')
                ->update(['total' => $invoice->total]);
        }

        \DB::table('invoices')->truncate();
        $query = 'INSERT INTO invoices (SELECT * FROM `temp_invoices`)';
        \DB::unprepared($query);

        return redirect()->route('invoice.list');
    }

    public function csvFixLineTerminator(string $path)
    {
        $file = file_get_contents($path);
        $file = str_replace("\r\n", "\n", $file);
        $file = str_replace("\r", "\n", $file);
        $file = str_replace("\n\n", "\n", $file);
        file_put_contents($path, $file);
    }

    public function fixlocalpathslashes($path)
    {
        return str_replace('//', '/', str_replace('\\', '/', $path));
    }
}
