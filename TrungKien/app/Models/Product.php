<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['product_category_name', 'product_type_name'];

    // choose specific colum 
    //  get the  category from specific product

    public  function category()
    {
        return $this->belongsTo('App\Models\Category', 'product_category_id', 'product_category_id');
    }
    
    public function getProductCategoryNameAttribute()
    {
        return $this->category->product_category_name;
    }

    public function getProductImageAttribute($value)
    {
        return  explode(",", $this->attributes['product_image']);
    }
    public function getProductTypeNameAttribute($value)
    {
        return $this->category->ProductType->product_type_name;
    }


    
    // public static function getProductInfor(){
    //     $products = Product::orderBy('updated_at', 'DESC')->get();
    //     foreach($products as $product){
    //         $product->product_category_name = $product->category->product_category_name;
    //         $product->product_image = explode(",", $product->product_image)[0];
    //     }
    //     return  $products;
    // }
}
