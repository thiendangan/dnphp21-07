<?php

namespace App\Http\Controllers;
use App\Models\SubType;

use Illuminate\Http\Request;

class SubTypeController extends Controller
{
    function list(){
        return $this->type_service->list();
    }
    
}
