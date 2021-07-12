<?php

namespace App\Repositories;
use App\Models\SubType;

class SubTypeRepository
{

    protected $type;

    public function __construct(SubType $sub_type)
    {
        $this->sub_type = $sub_type;
    }

    function sortById(){
        return $this->sub_type->orderBy('id', 'desc');
    }

    
}