<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function insert(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->avatar = 'https://via.placeholder.com/150';
        $user->save();

        return response('Successful registraion. You can log in now!', 201);
    }
}
