<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use Illuminate\Support\Str;
use App\Http\Requests\StoreAndUpateProductTypRequest;

class ProductTypeController extends Controller
{
    public  $title = 'producttype';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types = ProductType::orderBy('created_at', 'DESC')->paginate(5);
        $currentPage = $product_types->toArray()['current_page'];
        $perPage = $product_types->toArray()['per_page'];
        return view('producttype', ['product_types' => $product_types, 'index' => $perPage * ($currentPage - 1) + 1,'title' => $this->title]);
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
        $product_type = new ProductType();
        $product_type->	product_type_id = Str::random(5);
        $product_type->product_type_name = ucfirst($request->ProductType);
        $product_type->save();
        return back()->with('success', 'Thêm mới loại sản phẩm thành công !');
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
        $product_type_name = ProductType::where('product_type_id',$id)->first();
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
        $product_type =  ProductType::where('product_type_id',$id)->first();
        $product_type->product_type_name = ucfirst( $request->ProductType );
        $product_type->save();
        return redirect('/admin/producttype ')->with('success', 'Đã chĩnh sửa loại sản phẩm thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductType::where('product_type_id',$id)->delete();
        return back()->with('success', 'Đã xóa loại sản phẩm thành công !');
    }
}
