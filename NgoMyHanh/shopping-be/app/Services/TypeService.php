<?php

namespace App\Services;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Repositories\TypeRepository;
class TypeService
{
    public function __construct( TypeRepository $type_repository)
    {
        $this->type_repository = $type_repository;
    }
    public function list()
    {
        $type = $this->type_repository->sortById()->get();
        return response()->jsonOk($type, 200);
    }
    public function find(Request $request)
    {
        $payload    = $request->all();
        $type       = $this->type_repository->findById($payload['id']);
        return response()->jsonOk($type, 200);
    }
    
}