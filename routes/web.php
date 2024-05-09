<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/sorter', function () {
    return view('auth.sorter');
});
Route::post('sorter',[AuthController::class,'sorter'])->name('sorter');