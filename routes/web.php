<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\SorterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LotteryController;

//Route::get('/logg', function () {
//    return view('auth.logg');
//});
 // Route to the login view
Route::get("/",function(){
    return view("ticket.index");
})->name("index");
//Route::get('/login',function(){
  //  return view('auth.login');
//});

// Route to the register view
Route::get('/register', function () {
    return view('auth.register');
});

 // Route to the sorter view
Route::get('/sorter', function () {
    return view('auth.sorter');
});
// Route to display the login form
Route::get('login',[AuthController::class,'loginForm'])->name('loginForm');
// Route to handle login form submission
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
// Route to display the register form
Route::get('register',[AuthController::class,'registerForm'])->name('registerForm');
// Route to handle register form submission
Route::post('register',[SorterController::class,'store'])->name('register');

// Routes for sorter management
Route::get('sorter',[SorterController::class,'index'])->name('sorters.index');
Route::post('sorters/{sorter}/toggle',[SorterController::class,'toggle'])->name('sorters.toggle');
Route::get('sorters/search',[SorterController::class,'search'])->name('sorters.search');
//Route for home page
Route::get('home',[HomeController::class,"form"])->name("homeForm");

// Routes for ticket purchasing
Route::get('/tickets',[TicketController::class,'index'])->name('tickets.index');
Route::post('/tickets',[TicketController::class,'store'])->name('tickets.store');
Route::post('/tickets/pre_confirmation', [TicketController::class, 'pre_confirmation'])->name('tickets.pre_confirmation');

// Routes for lottery management
Route::get('lotteries',[LotteryController::class,"index"])->name("lotteries.index");
Route::get("lotteries/{lottery}/store",[LotteryController::class,"register"])->name("lotteries.register");
Route::post("lotteries/store",[LotteryController::class,"store"])->name("lotteries.store");
// Middleware to enforce authentication for 'user' and 'admin' roles, and to ensure email verification
Route::middleware(['auth:user,admin', 'verified']);
// Route for serving logo image
Route::get('logo.png', [LogoController::class, 'show']);
