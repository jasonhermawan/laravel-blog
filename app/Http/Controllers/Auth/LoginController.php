<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $loginData = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($loginData)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors('Username or password not valid.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
