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

        $products   = $this->product_repository->sortById();
        if ($payload['type_id']!="null") {
            $products   = $this->product_repository->findByTypeId($payload['type_id']);
        }
        if ($payload['sub_type_id']!="null") {
            $products   = $this->product_repository->findBySubTypeId($payload['sub_type_id']);   
        }
        if (strlen($payload['key_word'])>2){
            $products =  $this->product_repository->findByKeyWord($products,$payload['key_word']);
        }
        $products   = $products->paginate(10);
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
        $product->sub_image=$product->SubImages;
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
             $this->product_repository->delete($product);
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