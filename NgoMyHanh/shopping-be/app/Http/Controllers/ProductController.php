<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SubTypeController;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $type_controller;
    private $sub_type_controller;
    public function __construct(
        TypeController $TypeController,
        SubTypeController $SubTypeController

    ){
        $this->type_controller = $TypeController;
        $this->sub_type_controller = $SubTypeController;
    }

    function list(Request $request){
        $payload = $request->all();
        $products= Product::orderBy('created_at', 'desc');

        if ($payload['type_id']!=null) {
            $products= $products-> Where('type_id',$payload['type_id']);    
        }
        if ($payload['sub_type_id']!=null) {
            $products= $products-> Where('sub_type_id',$payload['sub_type_id']);    
        }
        
        $products= $products->get();
        $products = $products->map(function ($product) {
            $type       = $product->Type()->get()->toArray();
            $sub_type   = $product->SubType()->get()->toArray();
            $image      = $product->Image()->get()->toArray();

            $product->type_name     =$type[0]['name'];
            $product->sub_type_name =$sub_type[0]['name'];
            $product->image_path    =$image[0]['path'];
            return $product;
        });
         return $products;
    }
    function create(Request $request){
        $payload = $request->all();
        $product = Product::create($payload);
        return response()->json([
            'status' => true,
            'data'   => $product
        ]);
    }
    function find(Request $request){
        $payload = $request->all();
        $product = Product::find($payload['id']);

        $type       = $product->Type()->get()->toArray();
        $sub_type   = $product->SubType()->get()->toArray();
        $image      = $product->Image()->get()->toArray();

        $product->type_name     =$type[0]['name'];
        $product->sub_type_name =$sub_type[0]['name'];
        $product->image_path    =$image[0]['path'];
      
        return $product;
    }
    function update(Request $request){
        $payload = $request->all();
        $product = tap(Product::findOrFail($payload["id"]))
            ->update($payload);
        return $product;
    }
    function delete(Request $request){
        $payload = $request->all();
        $product = Product::find($payload['id']);
        if ($product)
        {
            $product->delete();
            return "deleted";
        }else{
            return "false";
        }
    
    }
    function search(Request $request){
        $payload = $request->all();
        $key_word=$payload['key_word'];
        $product = Product::where('name','like','%' . $key_word . '%')->get();
        return $product;
    
    }
}
