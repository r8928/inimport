<?php

namespace App\Http\Controllers;

use App\Models\Config;

class ConfigController extends Controller
{
    public function forceToEmail()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        Config::updateOrCreate(
            ['key' => 'force-to-email'],
            ['value' => request('email')],
        );

        return back();
    }
}
