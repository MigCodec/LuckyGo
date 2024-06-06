<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * HomeController handles redirection to different views based on the authenticated user type.
 */
class HomeController extends Controller
{
    public function form(){
         // Check if the authenticated user belongs to the "sorter" guard
        if(auth()->guard("sorter")->check()){
            return view("homeSorter");
        }
         // Check if the authenticated user belongs to the "admin" guard
        if(auth()->guard("admin")->check()){
            return view("sorters");
        }
        //If no user is authenticated, redirect to the login view
        return view("login");
    }
}
