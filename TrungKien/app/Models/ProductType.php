<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';
    protected $primaryKey = 'product_type_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // lấy hết tất cả các category thuộc một thể loại
    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'product_type_id', 'product_type_id');
    }
    
    // lấy hết tất cả các product thuộc một thể loại
    public function products()
    {
        return $this->hasManyThrough('App\Models\Product', 'App\Models\Category', 'product_type_id', 'product_category_id', 'product_type_id');
    }
}
