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
    public function deleteById(){
        return $this->product->delete();
    }
    public function findByName($name)
    {
        return $this->product->where('name','like','%' . $name . '%');
    }
}