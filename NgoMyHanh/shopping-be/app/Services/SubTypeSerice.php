<?php

namespace App\Services;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Repositories\SubTypeRepository;
class SubTypeService
{
    public function __construct( SubTypeRepository $sub_type_repository)
    {
        $this->sub_type_repository = $sub_type_repository;
    }
    public function list()
    {
        $sub_type = $this->sub_type_repository->sortById()->get();
        return $sub_type;
    }
    
    
}