<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Str;
class ProductRepository 
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function getAllRepository()
    {
        return $this->product->orderBy('created_at', 'DESC');
    }
    public function getRepository($product_id)
    {
        return $this->product->where('product_id', $product_id);
    }
    public function createRepository($images, $categoryId, $productName, $productPrice, $productDescription)
    {
        $product = new Product;
        $product->product_image = $images;
        $product->product_category_id  = $categoryId;
        $product->product_id =  Str::random(5);
        $product->product_name = ucfirst($productName);
        $product->product_price = $productPrice;
        $product->product_description = ucfirst($productDescription);
        $product->save();
    }
    public function updateRepository($product_id,$images, $categoryId, $productName, $productPrice, $productDescription)
    {
        $product = $this->getRepository($product_id)->first();
        $product->product_image = $images;
        $product->product_category_id  = $categoryId;
        $product->product_id =  Str::random(5);
        $product->product_name = ucfirst($productName);
        $product->product_price = $productPrice;
        $product->product_description = ucfirst($productDescription);
        $product->save();
        return 'Edit sản phẩm thành công !';
    }
    public function deleteRepository($product_id)
    {
        return $this->product->destroy($product_id);
    }
    public function getAllProductType(){
        return ProductType::all();
    }
    public function getCategoryRepository($id){
        return ProductType::where('product_type_id', $id)->first()->categories;
    }
}
