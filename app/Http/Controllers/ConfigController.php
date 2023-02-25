<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Validation\ValidationException;

class ConfigController extends Controller
{
    public function index()
    {
        return view('config.index');
    }

    public function store()
    {
        foreach ([
            'send-from-email',
            'force-to-email',
            'company-email',
        ] as $key) {
            if (request()->has($key)) {
                request()->validate([$key => 'required|email']);

                Config::set($key, request($key));
            }
        }

        foreach ([
            'company-name',
            'company-address',
            'company-phone',
            'email-subject',
            'email-body',
        ] as $key) {
            if (request()->has($key)) {
                request()->validate([$key => 'required|string']);

                Config::set($key, request($key));
            }
        }


        return back();
    }

    public function storesuper()
    {
        if (auth()->user()->role != 'admin') {
            throw ValidationException::withMessages(['Only admin can change this setting']);
        }

        if (request()->has('application-title')) {
            request()->validate(['application-title' => 'required|string']);

            Config::set('application-title', request('application-title'));
        }

        if (request()->has('max-file-size')) {
            request()->validate(['max-file-size' => 'numeric|max:50']);

            Config::set('max-file-size', (int) request('max-file-size'));
        }

        if (request()->has('max-mails-per-day')) {
            request()->validate(['max-mails-per-day' => 'numeric|max:100000']);

            Config::set('max-mails-per-day', (int) request('max-mails-per-day'));
        }

        if (request()->has('max-demo-mails-per-day')) {
            request()->validate(['max-demo-mails-per-day' => 'numeric|max:100']);

            Config::set('max-demo-mails-per-day', (int) request('max-demo-mails-per-day'));
        }

        if (request()->has('demo-mode')) {
            Config::set('demo-mode', (int) request()->boolean('demo-mode'));
        }

        return back();
    }
}
