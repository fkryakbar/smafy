<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'user') {
                return redirect()->to('dashboard');
            } else if (Auth::user()->role == 'admin') {
                return redirect()->to('admin');
            }
        }
        return view('landingPage.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'user') {
                return redirect()->intended('dashboard');
            } else if (Auth::user()->role == 'admin') {
                return redirect()->to('admin');
            }
        }

        return back()->with('failed', 'Email atau password salah');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
