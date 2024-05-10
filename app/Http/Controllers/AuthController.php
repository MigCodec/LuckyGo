<?php

namespace App\Http\Controllers;

use App\Models\Sorter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function sorter(Request $request)
    {
        dd($request->all());
        $messages = [
            'name.required' => 'Debe ingresar el campo nombre del sorteador',
            'age.required' => 'Debe ingresar la edad del sorteador',
            'age.integer' => 'La edad del sorteador debe ser numérica',
            'age.between' => 'La edad del sorteador no puede ser inferior a 18 y mayor a 65',
            'mail.required' => 'Debe ingresar el correo electrónico del sorteador',
            'mail.unique' => 'El correo electrónico ingresado ya existe en el sistema',
        ];

        $validated= $request->validate([
            'name'=>['required'],
            'age' =>['required', 'integer', 'between:18,65'],
            'mail'=>['required', 'unique:Sorters']
        ],$messages);

        do{
            $password = Str::randomNumber(6, true);
        }while(
            $password[0] === '0'
        );

        Sorter::create([
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
            'password' => $password,
            'status' => 1,
        ]);

        Mail::raw("Su contraseña es: $password", function ($message) use ($request){
            $message->to($request->mail)->subject('Contraseña Lucky Go');
        });

        auth()->attempt([
            'mail' => $request->mail,
            'password' => $password,
        ]);
    }


    public function login(Request $request){

        $messages=[
            'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
            'password.required' => 'debe ingresar su contraseña para iniciar sesión'
        ];

        $validated= $request->validate([
            'email'=>['required'],
            'password'=>['required']
        ],$messages);

        if (Auth::guard('sorter')->attempt(['email' => $request->email, 'password' => 
             $request->password], $request->remember)) {
            return redirect()->back()->with("login_successfuly","Se inicio sesión correctamente");
        }
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
    public function loginForm(){
        return view("auth.login");
    }
    public function registerForm(){
        if(auth()->guard("admin")->check()){
            return view("auth.register");
        }
        if(auth()->guard("sorter")->check()){
            return redirect()->back()->with("message","No esta permitido con esta cuenta");
        }
        return redirect()->back()->with("message","Debes logearte primero");
    } 

}

