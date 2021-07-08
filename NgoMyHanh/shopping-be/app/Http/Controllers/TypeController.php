<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
   
    function find($id){
        $type=Type::find($id);
        return $type;
    }
    function list(){
        $types= Type::orderBy('id', 'desc')->get();
        return $types;
    }
    
}
