<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Pagination\Paginator;

class ListProductRepository
{
    protected $category;
    protected $product;
    protected $productType;
    private $itemPerpage = 12;

    public function __construct(Category $category, Product $product, ProductType $productType)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productType = $productType;
    }
    public function getSpecificProductRepository($id){
        return $this->product->where('product_id',$id)->first();
    }
    public function getProductTypesRepository()
    {
        return $this->productType->all();
    }
    public function getProductsRepository()
    {
        return $this->product->paginate($this->itemPerpage)->withPath('/searchResult');
    }
    public function getCategoriesRepository($productType)
    {
        return $this->productType->where('product_type_id', $productType)->first()->categories;
    }
    public function getProductsSearchRepository($searchText)
    {
        if( $searchText == '')
        return $this->product->paginate($this->itemPerpage)->withPath('/searchResult');
        else
        return $this->product->where('product_name', 'LIKE', '%' . $searchText . '%')->orderBy('created_at', 'DESC')->paginate($this->itemPerpage)->withPath('/searchResult');
    }
    public function getProductsSearchRelyOnCategoryService($productType,$category,$searchText){
        if(!empty($searchText))
        return $this->category->where([['product_type_id', $productType], ['product_category_id', $category]])->first()->products()->where('product_name', 'LIKE', '%' . $searchText . '%')->orderBy('created_at', 'DESC')->paginate($this->itemPerpage)->withPath('/searchResult');
        else
        return $this->category->where([['product_type_id', $productType], ['product_category_id', $category]])->first()->products()->paginate($this->itemPerpage)->withPath('/searchResult');
    }
    public function  getProductsSearchRelyOnProductTypeService($productType,$category,$searchText){
        if($searchText == '')
        return $this->productType->where('product_type_id', $productType)->first()->products()->paginate($this->itemPerpage)->withPath('/searchResult');
        else
        return $this->productType->where('product_type_id', $productType)->first()->products()->where('product_name', 'LIKE', '%' . $searchText . '%')->orderBy('created_at', 'DESC')->paginate($this->itemPerpage)->withPath('/searchResult');
    }
}
