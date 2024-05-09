<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        if(auth()->attempt($request->only('email','password'),$request->remember)){
            return redirect()->route("registerForm");
        }
        return redirect()->back()->with("message","Credenciales incorrectas");
    }
    public function loginForm(){
        return view("auth.login");
    }
    public function registerForm(){
        if(auth()->check()){
            return view("auth.register");
        }
        return redirect()->back()->with("message","Debes logearte primero");
    }
}
