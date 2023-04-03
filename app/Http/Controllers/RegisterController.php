<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('landingPage.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Password harus diisi',
            'email.email' => 'Email tidak Valid',
            'password.min' => 'Minimal password 3 huruf',
            'password.confirmed' => 'Konfirmasi Password salah'
        ]);

        $request->merge(['role' => 'user']);
        $request->merge(['password' => bcrypt($request->password)]);
        $data = $request->except(['_token']);
        User::create($data);
        return redirect('/register')->with('msg', 'Akun berhasil dibuat, silahkan login');
    }
}
