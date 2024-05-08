<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

class AuthController extends Controller
{
    public function logg(Request $request)
    {
        $messages = [
            
            'uname.required' => 'Debe ingresar el correo electrónico',
            'psw.required' => 'Debe ingresar contraseña',
        ];

        $validated= $request->validate([
            
            'uname'=>['required'],
            'psw'=>['required']
        ],$messages);

        logg::create([
            
            'uname' => $request->uname,
            'psw' => $request->psw,
            
        ]);

        auth()->attempt([
            'uname' => $request->uname,
        ]);
    }
}
