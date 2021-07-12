<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;

class HomeController extends Controller
{
    public $title= 'home';
    public function index(){
        // use count DB
        $global_infor = [];
        $global_infor[]= Product::count();
        $global_infor[] = Category::count();
        $global_infor[] = ProductType::count();
        return view('index')->with('title',$this->title)->with('global_infor',$global_infor);
    }
}
