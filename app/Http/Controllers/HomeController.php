<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index(){
        return view('Home.index');
    }

    public function department(){
        return view('Home.Department');
    }

}
