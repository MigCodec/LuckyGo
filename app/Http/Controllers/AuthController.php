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
     * Register a new sorter in the system.
     * 
     * It performs data validation, generates a random password, creates a new
     * sorter record in the database, sends an email with the password, and attempts
     * to authenticate the user.
     * 
     * @param   \Illuminate\Http\Request  $request 
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function sorter(Request $request)
    {
        $messages = [
            'name.required' => 'Debe ingresar el campo nombre del sorteador',
            'age.required' => 'Debe ingresar la edad del sorteador',
            'age.integer' => 'La edad del sorteador debe ser numérica',
            'age.between' => 'La edad del sorteador no puede ser inferior a 18 y mayor a 65',
            'mail.required' => 'Debe ingresar el correo electrónico del sorteador',
            'mail.unique' => 'El correo electrónico ingresado ya existe en el sistema',
        ];

         // Validate the request data
        $validated= $request->validate([
            'name'=>['required'],
            'age' =>['required', 'integer', 'between:18,65'],
            'mail'=>['required', 'unique:Sorters']
        ],$messages);

         // Generate a random 6-digit password, excluding leading zeros
        do{
            $password = Str::randomNumber(6, true);
        }while(
            $password[0] === '0'
        );

         // Create a new sorter record in the database
        Sorter::create([
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
            'password' => $password,
            'status' => 1,
        ]);

         // Send an email with the generated password
        Mail::raw("Su contraseña es: $password", function ($message) use ($request){
            $message->to($request->mail)->subject('Contraseña Lucky Go');
        });

        // Attempt to authenticate the user
        auth()->attempt([
            'mail' => $request->mail,
            'password' => $password,
        ]);
    }


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
            return redirect()->back()->with("login_successfuly","Se inicio sesión correctamente");
        }
        //Validate the admin user
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => 
             $request->password], $request->remember)) {
            return redirect()->intended(route('registerForm'));
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

}

