<?php

namespace App\Http\Controllers;

use App\Models\Sorter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{



    /**
     * Authenticate a user and manages the login process.
     * 
     *  Validates the provided email and password, attempts authentication with the
     * appropriate guard, and redirects the user or displays an error message.
     * @param \Illuminate\Http\Request $request class instance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request){

        // Show a messagge of error
        $messages=[
            'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
            'password.required' => 'debe ingresar su contraseña para iniciar sesión'
        ];

        // Validate the request data
        $validated= $request->validate([
            'email'=>['required'],
            'password'=>['required']
        ],$messages);

        // Validate the sorter user
        if (Auth::guard('sorter')->attempt(['email' => $request->email, 'password' => 
             $request->password], $request->remember)) {
                return redirect()->intended(route('homeForm'));
        }
        //Validate the admin user
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => 
             $request->password], $request->remember)) {
            return redirect()->intended(route('homeForm'));
        }
        return redirect()->back()->with("message","usuario no registrado o contraseña incorrecta");
        /*
        if(auth()->attempt($request->only('email','password'),$request->remember)){
            return redirect()->route("registerForm");
        }
        return redirect()->back()->with("message","Credenciales incorrectas");
        */
    }

    /**
     * Displays the login form.
     * @return \Illuminate\Contracts\View\View
     */
    public function loginForm(){
        return view("auth.login");
    }
    /**
     * Displays the register form checking the user. 
     */
    public function registerForm(){
        //Check if the user is authenticated as an admin, if the user is admin show the registration form.
        if(auth()->guard("admin")->check()){
            return view("auth.register");
        }
        //Check if the user is authenticated as a sorter, if the user is sorter show the message not allowed.
        if(auth()->guard("sorter")->check()){
            return redirect()->back()->with("message","No esta permitido con esta cuenta");
        }
        //If the user is not authenticated, redirect back with a message.
        return redirect()->back()->with("message","Debes logearte primero");
    } 
    public function logout(){
        Auth::guard("admin")->logout();
        Auth::guard("sorter")->logout();
        return redirect()->route("login");
    }

}

