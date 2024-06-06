<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Displays the application's logo.
 */
class LogoController extends Controller
{
    public function show(){
        $path = public_path('luckygo_logo.png');
        return Response::file($path, ['Cache-Control' => 'public, max-age=86400']);
    }
}
