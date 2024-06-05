<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function form(){
        if(auth()->guard("sorter")->check()){
            return view("homeSorter");
        }
        if(auth()->guard("admin")->check()){
            return view("sorters");
        }
        return view("login");
    }
}
