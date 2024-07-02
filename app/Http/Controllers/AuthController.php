<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Sorter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

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
                $sorter = Sorter::where('email','=', $request->email)->first();
                if($sorter->status){
                    return redirect()->intended(route('lotteries.index'));
                }
                Auth::guard('sorter')->logout();
                return redirect()->back()->with("message","Sorteador Deshabilitado");
        }
        //Validate the admin user
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => 
             $request->password], $request->remember)) {
            return redirect()->intended(route('sorters.index'));
        }
        return redirect()->back()->with("message","usuario no registrado o contraseña incorrecta");
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
        return redirect()->back()->with("message","Debes iniciar sesión primero");
    } 

    public function logout(){
        Auth::guard("admin")->logout();
        Auth::guard("sorter")->logout();
        return redirect()->route("index");
    }

    public function change_password_form(){
        //Check if the user is authenticated as an admin, if the user is admin show the change password form.
        if(auth()->guard("admin")->check() || auth()->guard("sorter")->check()){
            return view("auth.changePassword");
        }
        //If the user is not authenticated, redirect back with a message.
        return redirect()->back()->with("message","Debes iniciar sesión primero");
    }

    public function change_password(Request $request){
        
        $admin = Auth::guard('admin')->user();
        $sorter = Auth::guard('sorter')->user();
        $id = 0;
        $is_admin = false;

        if($admin == null && $sorter != null){
            $id = $sorter->id;
        }

        if($admin != null && $sorter == null){
            $id = $admin->id;
            $is_admin = true;
        }

        if($id == 0){
            return redirect()->back()->with("message","No autorizado");
        }
        
        // Show a messagge of error
        $messages=[
            'password1.required' => 'debe completar ambos campos asociados a la contraseña',
            'password2.required' => 'debe completar ambos campos asociados a la contraseña'
        ];

        // Validate the request data
        $validated= $request->validate([
            'password1'=>['required'],
            'password2'=>['required']
        ],$messages);
        

        if($request->password1 != $request->password2){

            return redirect()->back()->with("error_password_diferent","Las contraseñas no coinciden");
        }

        $char = substr($request->password1, 0, 1);
        if($char == "0" || strlen($request->password1) != 6){

            return redirect()->back()->with("error_first_char","La contraseña es menor a seis dígitos o comienza con el número 0");
        }

        if($is_admin){
            $admin = Administrator::find($id);
            $admin->password = Hash::make($request->password1);
            $admin->save();
            return redirect()->route("login")->with("change_password_successfully","Cambio exitoso. Ingerese con su nueva contraseña.");
        }
        
        $sorter = Sorter::find($id);
        $sorter->password = Hash::make($request->password1);
        $sorter->save();
        return redirect()->route("login")->with("change_password_successfully","Cambio exitoso. Ingerese con su nueva contraseña.");
    }
}