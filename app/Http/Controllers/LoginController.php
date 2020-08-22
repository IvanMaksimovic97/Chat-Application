<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/home');
        }
        else{
            return redirect()->back()->with('error', 'Incorrect login! Wrong email or password.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
