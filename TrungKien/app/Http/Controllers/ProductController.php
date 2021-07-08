<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public  $title = 'product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Product();
        $temp =  $products->getproductData()->toArray();
        $temp1 = $products->getproductinfor();
        for($i = 0 ; $i< count($temp);$i++){
            $temp[$i]->product_category_name =  $temp1 [$i];
        }
       
        return view('product',['products' => $temp,'i' => 1,'title'=>$this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ProductTypes = ProductType::all('product_type_name');
        return view('addproduct',['title'=> $this->title , 'ProductTypes' => $ProductTypes]);
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
            'ProductName' => 'required|unique:posts|max:200',
            'Productprice' => 'required|max:20|numeric',
            'ProductType' => 'required',
            'ProductCategory' => 'required',
            'Description' => 'max:200',
            'ProductImage.*' => 'bail|required|image|mimes:jpg,png,jpeg|max:2048'
        ],[

            'ProductName.required' => "Vui lòng nhập tên sản phẩm",
            'ProductName.unique' => "Tên đã tồn tại vui lòng nhập tên khác",
            'ProductName.max' => 'Tên dài hơn 200 kí tự vui lòng nhập lại',
            'Productprice.required' => "Vui lòng nhập giá của sản phẩm",
            'Productprice.max' => "Vui lòng nhập giá có số kí tự nhỏ hơn 20",
            'Productprice.numeric' => "Vui lòng nhập giá sản phẩm bằng số",
            'ProductType.required' => "Vui lòng chọn loại sản phẩm",
            'ProductCategory.required' => "Vui lòng chọn danh mục sản phẩm",
            'Description.max' => 'Vui lòng nhập description nhỏ hơn 200 kí tự',
            'ProductImage.*.required' => "Vui lòng upload ảnh sản phẩm",
            'ProductImage.*.image'   => "vui lòng upload file ảnh",
            'ProductImage.*.mimes'   => "vui lòng upload file .jpg, .jpeg ,.png",
        ]);
        $product = new Product();
        $product->product_id = Str::random(5);
        $product->product_name = $request->ProductName;
        $product->product_price = $request->ProductPrice;
        $product->product_description =  $request->Description;
        // $product->product_category_id = ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('detailproduct')->with('title',$this->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('editproduct')->with('title',$this->title);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('product')->with('title',$this->title);
    }
}
