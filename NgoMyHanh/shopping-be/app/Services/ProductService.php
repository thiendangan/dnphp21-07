<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
class ProductService
{
    public function __construct( ProductRepository $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    public function list(Request $request)
    {
        $payload    = $request->all();

        if ($payload['type_id']!=null) {
            $products   = $this->product_repository->findByTypeId($payload['type_id']);
        }
        if ($payload['sub_type_id']!=null) {
            $products   = $this->product_repository->findBySubTypeId($payload['sub_type_id']);   
        }
        
        $products   = $products->get();
        $products   = $products->map(function ($product) {
            $type       = $product->Type()->first();
            $sub_type   = $product->SubType()->first();
            $image      = $product->Image()->first();

            $product->type_name     = $type->name;
            $product->sub_type_name = $sub_type->name;
            $product->image_path    = $image->path;
            return $product;
        });
         return $products;
    }

    public function create(Request $request)
    {
        $payload    = $request->all();
        $product    = $this->product_repository->create($payload);
        return response()->json([
            'status' => true,
            'data'   => $product
        ]);
    }
    public function find(Request $request){
        $payload = $request->all();
        $product = $this->product_repository->findById($payload['id']);
        
        $type       = $product->Type()->first();
        $sub_type   = $product->SubType()->first();
        $image      = $product->Image()->first();

        $product->type_name     = $type->name;
        $product->sub_type_name = $sub_type->name;
        $product->image_path    = $image->path;

      
        return $product;
    }
    public function update(Request $request){
        $payload = $request->all();
        $product = $this->product_repository->update($payload);

        return $product;
    }
    public function delete(Request $request){
        $payload = $request->all();
        $product =  $this->product_repository->findById($payload['id']);
        if ($product)
        {
            $product =  $this->product_repository->delete();
            return "deleted";
        }else{
            return "false";
        }
    }
    public function search(Request $request){
        $payload = $request->all();
        $key_word=$payload['key_word'];
        $product =  $this->product_repository->findByName($key_word)->get();
        return $product;
    }
}