<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductType;
use Illuminate\Support\Str;
use App\Http\Requests\StoreAndUpdateCategoryRequest;


class CategoryController extends Controller
{
    public $title = 'category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories =  Category::orderBy('created_at', 'DESC')->paginate(5);
        $productTypes  = ProductType::orderBy('updated_at', 'DESC')->get();
        $currentPage = $productCategories->toArray()['current_page'];
        $perPage = $productCategories->toArray()['per_page'];
        return view('category', ['productCategories' => $productCategories, 'productTypes' => $productTypes,'index' => $perPage * ($currentPage - 1) + 1, 'title' => $this->title]);
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
    public function store(StoreAndUpdateCategoryRequest $request)
    {
        $request->validated();
        $category = new Category;
        $category->product_category_id = Str::random(5);
        $category->product_category_name  = ucfirst($request->categoryName) ;
        $category->product_type_id = $request->productType;
        $category->save();
        return back()->with('success', 'Thêm mới danh mục sản phẩm thành công !');
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
        $categroyInfor = Category::where('product_category_id', $id)->first();
        $productTypes = ProductType::all();
        return view('editcategory', ['categroyInfor' => $categroyInfor, 'productTypes' => $productTypes, 'title' => $this->title]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateCategoryRequest $request, $id)
    {
        $request->validated();
        $category = Category::where('product_category_id', $id)->first();
        $category->product_category_name  = ucfirst($request->categoryName) ;
        $category->product_type_id  = $request->productType;
        $category->save();
        return redirect('/admin/category')->with('success', 'Đã chĩnh sửa danh mục sản phẩm thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('product_category_id',$id)->delete();
        return back()->with('success', 'Đã xóa loại sản phẩm thành công !');
    }
}
