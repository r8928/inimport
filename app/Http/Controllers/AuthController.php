<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function postLogin()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $auth = auth()->attempt(['email' => request('email'), 'password' => request('password')]);

        if (!$auth) {
            return redirect()->route('login')->with('error', 'Invalid username or password');
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
