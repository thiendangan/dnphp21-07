<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpateProductTypRequest;
use App\Services\ProductTypeService;

class ProductTypeController extends Controller
{
    public  $title = 'producttype';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productType;

    public function __construct(ProductTypeService $productType)
    {
        $this->productType = $productType;
    }
    public function index()
    {
        $product_types = $this->productType->ProductTypesService();
        $index = $this->productType->getIndexPageService();
        return view('producttype', ['product_types' => $product_types, 'index' => $index,'title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpateProductTypRequest $request)
    {
        $request->validated();
        $message = $this->productType->saveProductTypeService($request->ProductType);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_type_name = $this->productType->getProductTypeService($id);
        return view('editproducttype', ['product_type_name' => $product_type_name, 'title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpateProductTypRequest $request, $id)
    {
        $request->validated();
        $message = $this->productType->updateProductTypeService($id,$request->ProductType);
        return redirect('/admin/producttype ')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->productType->destroyProductTypeService($id);
        return back()->with('success',$message);
    }
}
