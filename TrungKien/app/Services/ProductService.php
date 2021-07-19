<?php

namespace App\Services;

use Image;
use ImageSize;
use Illuminate\Support\Str;
use App\Repositories\ProductRepository;

class ProductService
{
    protected  $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public  function ProductsService()
    {
        return $this->product->getAllRepository()->paginate(10);
    }
    public  function getIndexPageService()
    {
        $currentPage = $this->ProductsService()->toArray()['current_page'];
        $perPage = $this->ProductsService()->toArray()['per_page'];
        $index = $perPage * ($currentPage - 1) + 1;
        return $index;
    }
    public  function ProductTypesService()
    {
        return  $this->product->getAllProductType();
    }
    public  function SaveProduct($request, $categoryId, $productName, $productPrice, $productDescription)
    {
        $images =  $this->resizeImageService($request, 'ProductImage');
        $this->product->createRepository($images, $categoryId, $productName, $productPrice, $productDescription);
        return 'Thêm mới sản phẩm thành công !';
    }
    public  function getSpecificProductService($id)
    {
        return  $this->product->getRepository($id)->first();
    }
    public function updateProductService($id, $request, $categoryId, $productName, $productPrice, $productDescription)
    {
        $images =  $this->resizeImageService($request, 'ProductImage');
        $message = $this->product->updateRepository($id,$images, $categoryId, $productName, $productPrice, $productDescription);
        return  $message ;
    }
    public function destroyProductService($id)
    {
        $product =  $this->product->getRepository($id)->first();
        foreach ($product->product_image as $item) {
            if (!empty($item)) {
                unlink(public_path() . '/ProductImage/' . $item);
            }
        }
        $this->product->deleteRepository($id);
        return 'Đã xóa  sản phẩm thành công !';
    }
    public function getCategoryService($id)
    {
        return $this->product->getCategoryRepository($id);
    }
    // resize image demension and save image name
    public  function resizeImageService($request, $name)
    {
        $imagelinks = "";
        if ($request->hasfile($name)) {
            foreach ($request->file('ProductImage') as $file) {
                $newName = time() . Str::random(4);
                $fileName =   $newName . '.' . $file->extension();
                $imageResize = Image::make($file->getRealPath());
                $imageResize->resize(ImageSize::width, ImageSize::height);  // chuyen thag const
                $imageResize->save(public_path() . '/ProductImage/' . $fileName, 80);
                $imagelinks .=  $fileName . ",";
            }
        }
        return $imagelinks;
    }
}
