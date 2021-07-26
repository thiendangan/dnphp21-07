<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Str;

class ProductTypeRepository
{
    protected $productType;

    public function __construct(ProductType $productType)
    {
        $this->productType = $productType;
    }
    public function getAllRepository()
    {
        return $this->productType->orderBy('created_at', 'DESC')->paginate(5);
    }
    public function getRepository($productTypeId)
    {
        return $this->productType->where('product_type_id', $productTypeId);
    }

    public function createRepository($productTypeName)
    {
        $product_type = new ProductType();
        $product_type->product_type_id = Str::random(5);
        $product_type->product_type_name = ucfirst($productTypeName);
        $product_type->save();
        return  'Thêm mới loại sản phẩm thành công !';
    }

    public function updateRepository($id, $productTypeName)
    {
        $product_type =  $this->getRepository($id)->first();
        $product_type->product_type_name = ucfirst($productTypeName);
        $product_type->save();
        return 'Đã chĩnh sửa loại sản phẩm thành công !';
    }
    public function deleteRepository($product_id)
    {
        return $this->productType->destroy($product_id);
    }
}
