<?php

namespace App\Http\Controllers;

use App\Models\Sorter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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

