<?php
namespace App\Services;
use App\Repositories\ProductTypeRepository;
class ProductTypeService{

    protected $productType;

    public function __construct(ProductTypeRepository $productType)
    {
        $this->productType = $productType;
    }

     public  function ProductTypesService(){
         return $this->productType->getAllRepository();
     }
     public function  getProductTypeService($id){
        return $this->productType->getRepository($id)->first();
     }
     public  function getIndexPageService()
     {
       $currentPage = $this->ProductTypesService()->currentPage();
       $perPage = $this->ProductTypesService()->perPage();
       $index = $perPage * ($currentPage - 1) + 1;
       return $index;
     }
    public  function  saveProductTypeService($productTypeName){
        $message =  $this->productType->createRepository($productTypeName);
        return $message;
    }

    public  function updateProductTypeService($id,$productTypeName){
        $message = $this->productType->updateRepository($id,$productTypeName);
        return $message;
    }
    public  function destroyProductTypeService($id){
       $message = $this->productType->deleteRepository($id);
       return 'Đã xóa loại sản phẩm thành công !';
    }
} 
?>