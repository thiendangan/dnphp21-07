<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // choose specific colum 
    //  get the  category from specific product
    public function get_category(){
        return $this->belongsTo('App\Models\Category','product_category_id','product_category_id');
    }
    // get all product in Product table
    public function getproductData(){
        $products = DB::table('product')->get();
        return $products;
    }
    public function getproductinfor(){
        $products = $this->all();
        $array = array();
        foreach($products as $product){
            $array[] = $product->get_category->product_category_name;
        }
         return  $array;
    }
    

}
