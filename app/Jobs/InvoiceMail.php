<?php

namespace App\Jobs;

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

        $elasticEmail->email()->send([
            'to' => 'tmp.rashid@gmail.com',
            'subject' => 'Invoice Mail',
            'from' => config('mail.from.address'),
            'bodyHtml' => view('invoice', compact('data', 'first'))->render(),
        ]);
    }
}
