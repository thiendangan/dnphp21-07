<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public $title = 'category';
    protected $category;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(CategoryService $category)
    {
      $this->category = $category;
    }
    public function index()
    {
        $productCategories = $this->category->CategoriesService();
        $productTypes  =   $this->category->ProductTypesService();
        $index =  $this->category->getIndexPageService();
        return view('category', ['productCategories' => $productCategories, 'productTypes' => $productTypes,'index' => $index, 'title' => $this->title]);
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
        $message = $this->category->SaveCategoryService($request->categoryName,$request->productType);
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
        $categroyInfor = $this->category->getCategoryService($id);
        $productTypes = $this->category->ProductTypesService();
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
        $message = $this->category->updateCategoryService($id,$request->categoryName,$request->productType);
        return redirect('/admin/category')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->category->destroyCategoryService($id);
        return back()->with('success', $message );
    }
}
