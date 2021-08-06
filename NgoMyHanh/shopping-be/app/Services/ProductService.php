<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Services\ImageService;
use App\Http\Requests\ImagePostRequest;
use Carbon\Carbon;
use App\Providers\AppServiceProvider;
use App\Repositories\ImageRepository;

class ProductService
{
    public function __construct( 
        ProductRepository $product_repository,
        ImageService      $image_service  ,
        ImageRepository   $image_repository
        )
    {
        $this->product_repository = $product_repository;
        $this->image_service      = $image_service;
        $this->image_repository   = $image_repository;
    }

    public function list(Request $request)
    {
        $payload    = $request->all();

        $products   = $this->product_repository->sortById();
        if ($payload['type_id']!="null") {
            $products   = $this->product_repository->findByTypeId($products,$payload['type_id']);
        }
        if ($payload['sub_type_id']!="null") {
            $products   = $this->product_repository->findBySubTypeId($products,$payload['sub_type_id']);   
        }
        if (strlen($payload['key_word'])>2){
            $products =  $this->product_repository->findByKeyWord($products,$payload['key_word']);
        }   
        $products   = $products->paginate(10);
        return response()->jsonOk($products, 200);
        
    }

    public function create(Request $request)
    {
        $payload    = $request->all();
        $product    = $this->product_repository->create($payload);
        return response()->jsonOk($product, 200);
    }
    public function find(Request $request){
        $payload = $request->all();
        $product = $this->product_repository->findById($payload['id']);   
        $sub_images_position = [];
        foreach($product->SubImages as $id => $image){
            foreach($product->sub_image_ids as $key => $value){
                if ($value==$image->id){
                    $sub_images_position[$key]["position"]=$key;
                    $sub_images_position[$key]["path"]=$image->path;
                    $sub_images_position[$key]["id"]=$image->id;
                    break;
                }
            }
        };
        $product->sub_images_position= $sub_images_position;
        
        return response()->jsonOk($product, 200);
    }
    public function update(Request $request){
        $app_url        ="http://localhost:8000/";
        $data           = json_decode($request->data,true);
        $check_delete   = json_decode($request->check,true);

        $product = $this->product_repository->findById($data['id']);   

        $sub_image_ids  = $product["sub_image_ids"];
        $image_id       = $product["image_id"] ;
        $files          = $request->file;
        for ($i = 1; $i <= 4; $i++) {
          if ($check_delete[$i] && isset($sub_image_ids[$i])){
                $image =  $this->image_repository->findById($sub_image_ids[$i]);
                $sub_image_ids[$i] = null;
                $this->image_repository->delete($image);
                unlink("images/".$image->name);
        }
        }

        if (isset($files)){
        foreach($files as $key => $file){
            if (!empty($file)){
            $date           = Carbon::now();
            $milliseconds   = (int)round(microtime(true) * 1000);
            $image_name     = $date->toDateString().$milliseconds.$file->getClientOriginalName();

            $storedPath     = $file->move('images', $image_name);
           
            $image          = [];
            $image['name']  = $image_name;
            $image['type']  = $file->getClientOriginalExtension();
            $image['path']  = $app_url."images/".$image_name;

            $image          = $this->image_repository->create($image);

            if($key == 0){
                $image_delete =  $this->image_repository->findById($image_id);
                $this->image_repository->delete($image_delete);
                unlink("images/".$image_delete->name);

                $image_id = $image->id;
            }else{
                $sub_image_ids[$key]=$image->id;
            }
        }
    }
}
        if($image_id){
            $data["image_id"] = $image_id;
        }
        if($sub_image_ids){
            $sub_image_ids = array_filter( $sub_image_ids, 'strlen' );
            $data["sub_image_ids"] = $sub_image_ids;
        }
        $product = $this->product_repository->update($data);
        return response()->jsonOk($product, 200);
    }
    public function delete(Request $request){
        $payload = $request->all();
        $product =  $this->product_repository->findById($payload['id']);
        if ($product)
        {
             $this->product_repository->delete($product);
             $this->image_repository->delete($product->image);
             unlink("images/".$product->image->name);
             return response()->jsonSuccess("deleted", 200);;
        }
        else{
            return response()->jsonError("false delete", 400);;
        }
    }
    public function search(Request $request){
        $payload = $request->all();
        $key_word=$payload['key_word'];
        $product =  $this->product_repository->findByName($key_word)->get();
        return response()->jsonOk($product, 200);
    }
   
}