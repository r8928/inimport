<?php

namespace App\Jobs;

use App\Models\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $to = Config::value('force-to-email') ?? $data->email;

        if (!$to) {
            return;
        }

        $elasticEmail->email()->send([
            'to' => $to,
            'subject' => 'Invoice Mail',
            'from' => config('mail.from.address'),
            'bodyHtml' => view('invoice', compact('data', 'first'))->render(),
        ]);
    }
}
