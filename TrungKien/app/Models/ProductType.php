<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';
    protected $primaryKey = 'product_type_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function get_all_category(){
        return $this->hasMany('App\Models\Category','product_type_id','product_type_id');
        // lấy hết tất cả các category thuộc một thể loại
    }
    public function get_all_product(){
        return $this->hasManyThrough('App\Models\Product','App\Models\Category','product_type_id','product_category_id','product_type_id');
         // lấy hết tất cả các product thuộc một thể loại
    }
    public function get_all_product_type(){
        return ProductType::orderBy('updated_at', 'DESC')->get();
    }
}