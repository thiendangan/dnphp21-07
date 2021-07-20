<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('admin/product/getProductType', 'App\Http\Controllers\ProductController@productType')->name('getProductTypeAjax');
Route::get('admin','App\Http\Controllers\HomeController@index')->name('home');
Route::resource('admin/product','App\Http\Controllers\ProductController');
Route::resource('admin/category', 'App\Http\Controllers\CategoryController');
Route::resource('admin/producttype', 'App\Http\Controllers\ProductTypeController');

Route::get('/','App\Http\Controllers\ListProductController@index');
Route::get('/detailProduct/{id}','App\Http\Controllers\ListProductController@detailProduct')->name('detailProduct');

Route::post('/searchResult', 'App\Http\Controllers\ListProductController@searchProducts')->name('searchProducts');


// this is for test

// use App\Models\ProductType;
// Route::get('test', function (){
//     // $production_builder = ProductType::where('ProductTypeId','=','FenD');
//     // $product_type = $production_builder->first();
//     // echo gettype($product_type);
//     // echo "<br>";
//     // echo ($production_builder->__toString());
//     // dd( $product_type);

//     //  $products = Product::all();
//     //  foreach($products as $product){
//     //       echo $product->get_category->ProductCategoryName."<br>";
//     //  }
     

//     // echo "<br>";
//     // echo "<pre>";
//     // var_dump($product_type);
//     // echo "</pre>";
//     // $product_type = ProductType::all()->first()->get_all_category;
//     // // foreach($product_type->get_all_product as $item){
//     // //        echo $item->ProductName."<br>";
//     // // }
//     // echo $product_type;
// });

