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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=>['required'],
            "age"=>['required'],
            "email"=>['required','email']
        ]);
        $password_1digit = rand(1, 9);
        $password_remain = rand(10000, 99999);
        $password = $password_1digit . $password_remain; 
        DB::table('sorters')->insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'age'=>$request->age,
            'status'=>0,
            'password'=>Hash::make($password)
        ]);
        //mail($request->email,"test","this is a test message");
        Mail::raw("Su contraseña es: $password", function ($message) use ($request){
            $message->to($request->email)->subject('Contraseña Lucky Go');
        });
        return redirect()->back()->with("message","sorteador creado!");
        //
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
