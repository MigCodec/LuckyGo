<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SorterController;
use App\Http\Controllers\HomeController;

//Route::get('/logg', function () {
//    return view('auth.logg');
//});
 // Route to the login view
Route::get("/",function(){
    return view("auth.login");
});

// Route to the register view
Route::get('/register', function () {
    return view('auth.register');
});

 // Route to the sorter view
Route::get('/sorter', function () {
    return view('auth.sorter');
});
// Route to manage form submission for sorting
Route::post('sorter',[AuthController::class,'sorter'])->name('sorter');
// Route to display the login form
Route::get('login',[AuthController::class,'loginForm'])->name('loginForm');
// Route to handle login form submission
Route::post('login',[AuthController::class,'login'])->name('login');
// Route to display the register form
Route::get('register',[AuthController::class,'registerForm'])->name('registerForm');
// Route to handle register form submission
Route::post('register',[SorterController::class,'store'])->name('register');
Route::get('sorters',[SorterController::class,"showForm"])->name("sorterForm");
Route::get('home',[HomeController::class,"form"])->name("homeForm");
// Middleware to enforce authentication for 'user' and 'admin' roles, and to ensure email verification
Route::middleware(['auth:user,admin', 'verified']);
