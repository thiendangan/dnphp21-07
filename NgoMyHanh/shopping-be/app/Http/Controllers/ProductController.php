<?php

namespace App\Http\Controllers;

use App\Services\ProductService;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $product_service;

    public function __construct(
        ProductService $ProductService

    ){
        $this->product_service = $ProductService;
    }

    function list(Request $request){
        return $this->product_service->list($request);
    }
    function create(Request $request){
        return $this->product_service->create($request);
    }
    function find(Request $request){
        return $this->product_service->find($request);
    }
    function update(Request $request){
        return $this->product_service->update($request);
    }
    function delete(Request $request){
        return $this->product_service->delete($request);
    }
    function search(Request $request){
        return $this->product_service->search($request);
    }
}
