<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SorterController;

//Route::get('/logg', function () {
//    return view('auth.logg');
//});
Route::get("/",function(){
    return view("auth.login");
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/sorter', function () {
    return view('auth.sorter');
});
Route::post('sorter',[AuthController::class,'sorter'])->name('sorter');
Route::get('login',[AuthController::class,'loginForm'])->name('loginForm');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('register',[AuthController::class,'registerForm'])->name('registerForm');
Route::post('register',[SorterController::class,'store'])->name('register');
