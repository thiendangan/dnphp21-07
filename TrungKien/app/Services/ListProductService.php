<?php
    namespace App\Services;
    use App\Repositories\ListProductRepository;
    use Illuminate\Pagination\Paginator;
    class ListProductService{
        protected $ListProduct;
        function __construct(ListProductRepository $ListProduct)
        {
            $this->ListProduct = $ListProduct;
        }
        function getProductsService(){
            return $this->ListProduct->getProductsRepository();
        }
        function getProductTypesService(){
            return $this->ListProduct->getProductTypesRepository();
        }
        function searchProductsService($request){
            if ($request->ajax()){
                $page = $request->page;
                $productType = str_replace(' ', '', $request->productType);
                $category = str_replace(' ', '', $request->category);
                $searchText = $request->searchText;
                
                // get current page
                if (!empty($page)) {
                  Paginator::currentPageResolver(function () use ($page) {
                    return $page;
                  });
                }
                // if user not select category and productType
                if ($productType == 'default' && $category == 'default'){
                  // if user  not search
                  if ($searchText == "")
                    $products = $this->ListProduct->getProductsSearchRepository($searchText);
                  else // if user have a search text
                    $products  = $this->ListProduct->getProductsSearchRepository($searchText);
                }else { // get categories relative with every productType
                  $categories = $this->ListProduct->getCategoriesRepository($productType);
                  $result['categories'] =  $categories;
                  if ($category != 'default') { // if user not select category
                    if ($searchText == "")
                      $products =  $this->ListProduct->getProductsSearchRelyOnCategoryService($productType,$category,$searchText);
                    else // if user take a search with text and specific category and productType
                      $products =  $this->ListProduct->getProductsSearchRelyOnCategoryService($productType,$category,$searchText);
                  } else{
                    if ($searchText == "")
                      $products =  $this->ListProduct->getProductsSearchRelyOnProductTypeService($productType,$category,$searchText);
                    else //  if user take a search with text and specific productType 
                      $products =  $this->ListProduct->getProductsSearchRelyOnProductTypeService($productType,$category,$searchText);
                  }
                } 
                // return result 
                $result['products'] =  $products;
                return  json_encode($result, JSON_UNESCAPED_UNICODE);
              }
        }
        public function getSpecificProductService($id){
            return $this->ListProduct->getSpecificProductRepository($id);
        }

    }
