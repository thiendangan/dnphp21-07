<?php

namespace App\Repositories;
use App\Models\Type;

class TypeRepository
{

    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }
    function sortById(){
        return $this->type->orderBy('id', 'desc');
    } 
    function findById($id){
        return $this->type->find($id);
    } 
}