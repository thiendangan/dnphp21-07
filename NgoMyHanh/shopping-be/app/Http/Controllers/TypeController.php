<?php

namespace App\Http\Controllers;
use App\Services\TypeService;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
   
    private $type_service;

    public function __construct(
        TypeService $TypeService

    ){
        $this->type_service = $TypeService;
    }
    function find(Request $request){
        return $this->type_service->find($request);
    }
    function list(){
        return $this->type_service->list();
    }
    
}
