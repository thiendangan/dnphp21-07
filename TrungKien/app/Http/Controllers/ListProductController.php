<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ListProductService;


class ListProductController extends Controller
{
  protected $ListProductService;
  function __construct(ListProductService $ListProductService)
  {
    $this->ListProductService = $ListProductService;
  }
  function index()
  {
    $products = $this->ListProductService->getProductsService();
    $productTypes = $this->ListProductService->getProductTypesService();
    return view('client\listProduct', ['products' => $products, 'productTypes' => $productTypes]);
  }
  function searchProducts(Request $request)
  {
    return  $this->ListProductService->searchProductsService($request);
  }
  function detailProduct($id)
  {
    $productInfor = $this->ListProductService->getSpecificProductService($id);
    $productTypes = $this->ListProductService->getProductTypesService();
    return view('client\detailProduct')->with('productInfor', $productInfor)->with('productTypes',$productTypes);
  }
}
