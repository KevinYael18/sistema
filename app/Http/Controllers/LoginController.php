<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $credenciales = $request->only('email','password');

        if(Auth::attempt($credenciales)){
            return redirect()->route('dashboard');
        }

        return back()->with('error','Credenciales incorrectas');

    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}