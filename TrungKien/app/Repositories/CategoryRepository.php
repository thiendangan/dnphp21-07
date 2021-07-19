<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Support\Str;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function getAllRepository()
    {
        return $this->category->orderBy('created_at', 'DESC');
    }
    public function getRepository($category_id)
    {
        return $this->category->where('product_category_id', $category_id);
    }

    public function createRepository($categoryName, $productType)
    {
        $category = new Category;
        $category->product_category_id = Str::random(5);
        $category->product_category_name  = ucfirst($categoryName);
        $category->product_type_id = $productType;
        $category->save();
        return 'Thêm mới danh mục sản phẩm thành công !';
    }
    public function updateRepository($id, $categoryName, $productType)
    {
        $category =$this->getRepository($id)->first();
        $category->product_category_name  = ucfirst($categoryName);
        $category->product_type_id  = $productType;
        $category->save();
        return 'Đã chĩnh sửa danh mục sản phẩm thành công !';
    }
    public function deleteRepository($product_id)
    {
        return $this->category->destroy($product_id);
    }
    
    public function getAllProductType()
    {
        return ProductType::all();
    }
}
