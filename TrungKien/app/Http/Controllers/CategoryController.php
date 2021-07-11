<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductType;
use Illuminate\Support\Str;

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
        $product_category = new Category();
        $product_type = new ProductType();
        $product_category =  $product_category->get_all_categories();
        $list_product_type  = $product_type->get_all_product_type();
        return view('category', ['product_category' => $product_category, 'list_product_type' => $list_product_type, 'title' => $this->title]);
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
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|unique:category,product_category_name|max:100',
            'product_type' => 'required'
        ], [
            'categoryName.required' => "Vui lòng nhập danh mục sản phẩm",
            'categoryName.unique' => "Tên danh mục sản phẩm đã tồn tại. Vui lòng nhập tên khác",
            'categoryName.max'  => "Vui lòng nhập tên loại sản phẩm dài dưới 100 ký tự",
            'product_type.required' => 'Vui lòng chọn loại sản phẩm'
        ]);
        $category = new Category();
        $category->product_category_id = Str::random(5);
        $category->product_category_name  = $request->categoryName;
        $category->product_type_id = $request->product_type;
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
        $categroy_infor = Category::where('product_category_id', $id)->first();
        $list_product_type = ProductType::all();
        return view('editcategory', ['categroy_infor' => $categroy_infor, 'list_product_type' => $list_product_type, 'title' => $this->title]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|unique:category,product_category_name|max:100',
            'product_type' => 'required'
        ], [
            'category_name.required' => "Vui lòng nhập tên danh mục sản phẩm",
            'category_name.unique' => "Tên danh mục sản phẩm đã tồn tại. Vui lòng nhập tên khác",
            'category_name.max'  => "Vui lòng nhập danh mục loại sản phẩm dài dưới 100 ký tự",
            'product_type.required' => 'Vui lòng chọn loại sản phẩm'
        ]);
        $category =  Category::where('product_category_id', $id)->first();
        $category->product_category_name  = $request->category_name;
        $category->product_type_id  = $request->product_type;
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
