<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $title= 'home';
    public function index(){
        return view('index')->with('title',$this->title);
    }
}
