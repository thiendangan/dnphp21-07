<?php

namespace App\Http\Controllers;
use App\Models\SubType;

use Illuminate\Http\Request;

class SubTypeController extends Controller
{
    function find($id){
        $sub_type=SubType::find($id);
        return $sub_type;
    }
}
