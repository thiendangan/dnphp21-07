<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAndUpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public  $title = 'product';
    protected $product;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    public function index()
    {   
        $products = $this->product->ProductsService();
        $index = $this->product->getIndexPageService();
        return view('product', ['products' => $products, 'index' => $index, 'title' => $this->title]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ProductTypes = $this->product->ProductTypesService();
        return view('addproduct', ['title' => $this->title, 'ProductTypes' => $ProductTypes]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateProductRequest $request)
    {
        $request->validated();
        $message =  $this->product->SaveProduct($request,$request->ProductCategory,$request->ProductName, $request->Productprice,$request->Description);
        return back()->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dung orm
        $productInfor = $this->product->getSpecificProductService($id);
        return view('detailproduct', ['title' => $this->title, 'productInfor' => $productInfor]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ProductTypes = $this->product->ProductTypesService();
        $productInfor = $this->product->getSpecificProductService($id);
        return view('editproduct', ['title' => $this->title, 'ProductTypes' => $ProductTypes, 'productInfor' => $productInfor]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateProductRequest $request,$id )
    {
        $request->validated();
        $message =  $this->product->updateProductService($id,$request,$request->ProductCategory,$request->ProductName, $request->Productprice,$request->Description);
        
        return redirect()->route('product.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message =  $this->product->destroyProductService($id);
        return back()->with('success',$message );
    }

    // function to settle when ajax call to get all Categories

    public function productType(Request $request)
    {
        $categories = $this->product->getCategoryService($request->ProductType);
        return json_encode($categories, JSON_UNESCAPED_UNICODE);
    }
}
