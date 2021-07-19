<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use OpenCloud\Common\Exceptions\JsonError;

// use function PHPSTORM_META\elementType;

class ListProductController extends Controller
{
  function index()
  {
    $products = Product::paginate(12)->withPath('/searchResult');
    // ->withPath('/admin/users');
    $productTypes = ProductType::all();
    return view('client\listProduct', ['products' => $products, 'productTypes' => $productTypes]);
  }
  function searchProducts(Request $request)
  {
    
    if ($request->ajax()) {
      $page = $request->page;
      $productType = str_replace(' ', '', $request->productType);
      $category = str_replace(' ', '', $request->category);
      $searchText = $request->searchText;
      
      // get current page
      if (!empty($page)) {
        Paginator::currentPageResolver(function () use ($page) {
          return $page;
        });
      }
      // if user not select category and productType
      if ($productType == 'default' && $category == 'default'){
        // if user  not search
        if ($searchText == "")
          $products = Product::paginate(12)->withPath('/searchResult');
        else // if user have a search text
          $products  = Product::where('product_name', 'LIKE', '%' . $searchText . '%')->orderBy('created_at', 'DESC')->paginate(8)->withPath('/searchResult');
      }else { // get categories relative with every productType
        $categories =  ProductType::where('product_type_id', $productType)->first()->categories;
        $result['categories'] =  $categories;
        if ($category != 'default') { // if user not select category
          if ($searchText == "")
            $products =  Category::where([['product_type_id', $productType], ['product_category_id', $category]])->first()->products()->paginate(8)->withPath('/searchResult');
          else // if user take a search with text and specific category and productType
            $products =  Category::where([['product_type_id', $productType], ['product_category_id', $category]])->first()->products()->where('product_name', 'LIKE', '%' . $searchText . '%')->orderBy('created_at', 'DESC')->paginate(8)->withPath('/searchResult');
        } else{
          if ($searchText == "")
            $products =  ProductType::where('product_type_id', $productType)->first()->products()->paginate(8)->withPath('/searchResult');
          else //  if user take a search with text and specific productType 
            $products =  ProductType::where('product_type_id', $productType)->first()->products()->where('product_name', 'LIKE', '%' . $searchText . '%')->orderBy('created_at', 'DESC')->paginate(8)->withPath('/searchResult');
        }
      } 

      // return result 

      $result['products'] =  $products;
      return  json_encode($result, JSON_UNESCAPED_UNICODE);
    }
  }
}
