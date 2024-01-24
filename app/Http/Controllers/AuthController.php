<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password', 'level');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); 
        }
        return redirect()->route('login')->with('error', 'Login failed. Check your credentials.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
