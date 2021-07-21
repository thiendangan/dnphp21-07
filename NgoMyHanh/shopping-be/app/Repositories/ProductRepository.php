<?php

namespace App\Repositories;
use App\Models\Product;

class ProductRepository
{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create(array $product)
    {
        return $this->product->create($product);
    }

    function sortById(){
        return $this->product->orderBy('id', 'desc');
    } 
    public function findByTypeId($type_id){
        return $this->product->Where('type_id',$type_id);    
    }
    public function findBySubTypeId($sub_type_id){
        return $this->product->Where('type_id',$sub_type_id);    
    }
    public function findById($id)
    {
        return $this->product->find($id);
    }
    public function update(array $product){
        return tap($this->product::findOrFail($product["id"]))
        ->update($product);
    }
    public function delete($product){
        return $product->delete();
    }
    public function findByName($name)
    {
        return $this->product->where('name','like','%' . $name . '%');
    }
    public function findByKeyWord($product,$key_word)
    {
        return $product->where('name','like','%' . $key_word . '%')
                       ->orWhere('code', 'like','%' . $key_word . '%'); 
    }

}