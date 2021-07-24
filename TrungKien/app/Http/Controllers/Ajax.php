<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;


class Ajax extends Controller
{
    public function index(Request $request)
    {
        $categories =  ProductType::where('product_type_name',$request->category)->first()->get_all_category;
        
        return json_encode($categories,JSON_UNESCAPED_UNICODE);
    }
}
