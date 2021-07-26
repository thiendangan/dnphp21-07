<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;


class HomeController extends Controller
{
    public $title= 'home';
    public function index(){
        // use count DB
        $global_infor = [];
        $global_infor['product_amount']= Product::count();
        $global_infor['category_amount'] = Category::count();
        $global_infor['product_type_amount'] = ProductType::count();
        return view('index')->with('title',$this->title)->with('global_infor',$global_infor);
    }
}
