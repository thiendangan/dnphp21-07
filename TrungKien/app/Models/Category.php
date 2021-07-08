<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'product_category_id';
    public $incrementing = false;
    protected $keyType = 'string';
    function get_producttype(){
        return $this->belongsTo('App\Models\ProductType','product_type_id','product_category_id');
        // lấy được loại sản phẩm thuộc một danh mục cụ thể
    }
    function get_all_product(){
        return $this->hasMany('App\Models\Product','product_category_id','product_category_id');
        // lấy tất cả sản phẩm thuộc một danh mục
    }
}
