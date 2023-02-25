<?php

namespace App\Jobs;

use App\Models\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class InvoiceMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $elasticEmail = new \ElasticEmail\ElasticEmail(config('mail.mailers.elastic_email.key'));

        $data = $this->data;
        $first = $this->data->first();

        $from = Config::value('send-from-email');
        $to = Config::value('demo-mode')
            ? Config::value('force-to-email')
            : $data->email;

        $subject = $this->text(Config::value('email-subject') ?? '');
        $body = $this->text(Config::value('email-body') ?? '');

        if (!$to) {
            logger('email not sent "$to" not set');
            return;
        }

        if (!$from) {
            logger('email not sent "$from" not set');
            return;
        }

        if (!$subject) {
            logger('email not sent "$subject" not set');
            return;
        }

        if (!$body) {
            logger('email not sent "$body" not set');
            return;
        }

        $pdf = Pdf::loadView('invoice.show', compact('data', 'first'));
        $file = $pdf->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->output();

        $file_path = 'uploads/' . $first->invoice_no . '.pdf';

        Storage::put($file_path, $file);
        $path = Storage::path($file_path);

        if (Storage::exists($file_path)) {
            $elasticEmail->email()->send([
                'to' => $to,
                'subject' => $subject,
                'from' => $from,
                'bodyHtml' => $body,
            ], [$path]);

            sleep(0.5);

            @Storage::delete($file_path);
        }
    }

    public function text($string)
    {
        $first = $this->data->first();
        $string = str_replace('[customer]', $first->customer_name, $string);
        $string = str_replace('[amount]', number_format($first->total, 2), $string);

        return $string;
    }
}
