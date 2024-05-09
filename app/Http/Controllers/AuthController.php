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
        return view("auth.register");
    }
    public function register(Request $request){
        $validated = $request->validate([
            "name"=>['required'],
            "email"=>['required','email']
        ]);
    }
}
