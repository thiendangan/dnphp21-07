<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    function index(){
      $products = Product::paginate(12);
      $categories = Category::alL();
      $productTypes = ProductType::all();
      return view('client\listProduct',['products' => $products, 'categories'=> $categories,'productTypes' => $productTypes]);
    }
    function search(){
        
    }
}
