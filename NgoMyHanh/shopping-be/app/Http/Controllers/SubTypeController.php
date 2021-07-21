<?php

namespace App\Http\Controllers;
use App\Models\SubType;

use Illuminate\Http\Request;
use App\Services\SubTypeService;

class SubTypeController extends Controller
{
    private $sub_type_service;

    public function __construct(
        SubTypeService  $SubTypeService

    ){
        $this->sub_type_service = $SubTypeService;
    }
    function list(){
        return $this->sub_type_service->list();
    }
    function listByTypeId(Request $request){
       return $this->sub_type_service->listByTypeId($request);
    }
    
}
