<?php

namespace App\Http\Controllers;

use App\Models\Sorter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SorterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Stores a new sorter record in the database and sends an email notification with the password.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //Define user error messages for field validation
        $messages = [
            'name.required' => 'Debe ingresar el campo nombre del sorteador',
            'age.required' => 'Debe ingresar la edad del sorteador',
            'age.integer' => 'La edad del sorteador debe ser numérica',
            'age.between' => 'La edad del sorteador no puede ser inferior a 18 y mayor a 65',
            'email.required' => 'Debe ingresar el correo electrónico del sorteador',
            'email.unique' => 'El correo electrónico ingresado ya existe en el sistema',
            'email.email' => 'Debe ingresar un correo válido',
        ];

        //validate request data
        $validated = $request->validate([
            "name"=>['required'],
            "age"=>['required', 'integer', 'between:18,65'],
            "email"=>['required','email', 'unique:sorters']
        ],$messages);

         // Generate a random password
        $password_1digit = rand(1, 9);
        $password_remain = rand(10000, 99999);
        $password = $password_1digit . $password_remain; 

        // Store the new sorter record in the database
        DB::table('sorters')->insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'age'=>$request->age,
            'status'=>0,
            'password'=>Hash::make($password)
        ]);
        try{
            // Send an email notification with the generated password
            Mail::raw("Su contraseña es: $password", function ($message) use ($request){
            $message->to($request->email)->subject('Contraseña Lucky Go');
            // Redirect the user back with a success message
            return redirect()->back()->with("message","sorteador creado!");
        });
        }catch(Exception $exception){
            return redirect()->back()->with("message_conection_error","Error de conexión");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sorter $sorter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sorter $sorter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sorter $sorter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sorter $sorter)
    {
        //
    }
}
