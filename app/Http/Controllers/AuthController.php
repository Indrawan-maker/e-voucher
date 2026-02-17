<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function showLogin()
{
    if (Auth::check()) {

        if (Auth::user()->role === 'superadmin') {
            return redirect('/superadmin/dashboard');
        }

        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
    }

    return view('login');
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        if (Auth::user()->role === 'superadmin') {
            return redirect('/superadmin/transaksi');
        }

        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
    }

    return back()->with('error', 'Email atau password salah!');
}


    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}