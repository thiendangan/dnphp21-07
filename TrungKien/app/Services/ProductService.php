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
        $currentPage = $this->ProductsService()->currentPage();
        $perPage = $this->ProductsService()->perPage();
        $index = $perPage * ($currentPage - 1) + 1;
        return $index;
    }
    public  function ProductTypesService()
    {
        return  $this->product->getAllProductType();
    }
    public  function SaveProductService($request,$name)
    {
        $images =  $this->resizeImageService($request, $name);
        $this->product->createRepository($images,$request->ProductCategory, $request->ProductName, $request->Productprice,$request->Description);
        return 'Thêm mới sản phẩm thành công !';
    }
    public  function getSpecificProductService($id)
    {
        return  $this->product->getRepository($id);
    }
    public function updateProductService($id, $request,$Name)
    {
        $images =  $this->resizeImageService($request,$Name);
        foreach ($request->backEndImages as $item) {
            if ($item != 'haschanged') {
                $images = $images . $item . ",";
            }
        }
        $message = $this->product->updateRepository($id, $images,$request->ProductCategory,$request->ProductName, $request->Productprice,$request->Description);
        return  $message;
    }
    public function destroyProductService($id)
    {
        $product =  $this->product->getRepository($id);
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
            foreach ($request->file($name) as $file) {
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
