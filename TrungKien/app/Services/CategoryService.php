<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
  protected  $category;

  public function __construct(CategoryRepository $category)
  {
    $this->category = $category;
  }
  public  function CategoriesService()
  {
    return $this->category->getAllRepository()->paginate(5);
  }
  public function getCategoryService($id){
    return $this->category->getRepository($id)->first();
  }
  public  function ProductTypesService()
  {
    return  $this->category->getAllProductType();
  }

  public  function getIndexPageService()
  {
    $currentPage = $this->CategoriesService()->toArray()['current_page'];
    $perPage = $this->CategoriesService()->toArray()['per_page'];
    $index = $perPage * ($currentPage - 1) + 1;
    return $index;
  }
  public  function  SaveCategoryService($categoryName, $productType)
  {
    $message = $this->category->createRepository($categoryName, $productType);
    return $message;
  }


  public  function updateCategoryService($id, $categoryName, $productType)
  {
    $message = $this->category->updateRepository($id, $categoryName, $productType);
    return $message;
  }
  public  function destroyCategoryService($id)
  {
    $this->category->deleteRepository($id);
    return 'Đã xóa loại sản phẩm thành công !';
  }
}
