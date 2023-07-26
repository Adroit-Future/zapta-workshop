<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginFormShow(){
        return view('admin.auth.login');
    }



    public function login(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard'); // Redirect to the client dashboard or any other page
        }
        // Authentication failed
        return back()->withErrors(['email' => 'Email or Password not match']);
    }


    public function logout(Request $request){

    }
}
