<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/logg', function () {
    return view('auth.logg');
});
Route::post('logg',[AuthController::class,'logg'])->name('logg');