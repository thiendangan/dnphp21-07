<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use CKSource\CKFinder\Image as CKFinderImage;
use Illuminate\Support\Str;
use Image;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public  $title = 'product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        $products = new Product();
        $temp =  $products->getproductData();
        $temp1 = $products->getproductinfor();
        for ($i = 0; $i < count($temp); $i++) {
            $temp[$i]->product_category_name =  $temp1[$i];
            $temp[$i]->product_image = explode(",", $temp[$i]->product_image)[0];
        }
        $temp = new \Illuminate\Pagination\Paginator($temp,5,$page);
        $temp->withPath('/admin/product');
        return view('product', ['products' => $temp, 'i' => 1, 'title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ProductTypes = ProductType::all('product_type_name');
        return view('addproduct', ['title' => $this->title, 'ProductTypes' => $ProductTypes]);
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
            'ProductName' => 'required|unique:product,product_name|max:200',
            'Productprice' => 'required|numeric|max:1000000000|min:1',
            'ProductType' => 'required',
            'ProductCategory' => 'required',
            'Description' => 'max:200',
            'ProductImage' => "bail|required",
            'ProductImage.*' => 'bail|image|mimes:jpg,png,jpeg|max:2048'
        ], [
            'ProductName.required' => "Vui lòng nhập tên sản phẩm",
            'ProductName.unique' => "Tên đã tồn tại vui lòng nhập tên khác",
            'ProductName.max' => 'Tên dài hơn 200 kí tự vui lòng nhập lại',
            'Productprice.required' => "Vui lòng nhập giá của sản phẩm",
            'Productprice.min'      => "vui lòng nhập giá sản phẩm theo thực tế",
            'Productprice.max' => "Vui lòng nhập giá sản phẩm có số kí tự nhỏ hơn 10",
            'Productprice.numeric' => "Vui lòng nhập giá sản phẩm bằng số",
            'ProductType.required' => "Vui lòng chọn loại sản phẩm",
            'ProductCategory.required' => "Vui lòng chọn danh mục sản phẩm",
            'Description.max' => 'Vui lòng nhập description nhỏ hơn 200 kí tự',
            'ProductImage.required' => 'Vui lòng upload ảnh sản phẩm',
            'ProductImage.*.image'   => "vui lòng upload file ảnh",
            'ProductImage.*.mimes'   => "vui lòng upload file .jpg, .jpeg ,.png",
        ]);
        $product = new Product();
        $imagelinks = "";
        // resize image demension and save
        if ($request->hasfile('ProductImage')) {
            foreach ($request->file('ProductImage') as $file) {
                $newname = time().Str::random(4);
                $filename =   $newname.'.'.$file->extension();
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(960,600);
                $image_resize->save(public_path() . '/ProductImage/'.$filename,80);
                $imagelinks .=  $filename.",";
            }
            $product->product_image = $imagelinks;
            $product->product_category_id  = $request->ProductCategory;
            $product->product_id =  Str::random(5);
            $product->product_name = $request->ProductName;
            $product->product_price = $request->Productprice;
            $product->product_description =  $request->Description;
            $product->save();
            return back()->with('success', 'Thêm mới sản phẩm thành công !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_infor =  Product::where('product_id',$id)->first();
        $product_infor->product_image = explode(",",$product_infor->product_image);
        $product_infor->ProductTypeName = Product::where('product_id',$id)->first()->get_category()->first()->get_producttype()->first()->product_type_name;
        $product_infor->CategoryName = Product::where('product_id',$id)->first()->get_category()->first()->product_category_name;
        return view('detailproduct',['title'=>$this->title,'product_infor' => $product_infor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ProductTypes = ProductType::all('product_type_name');
        $product_infor = Product::where('product_id',$id)->first();
        $product_infor->product_image = explode(",",$product_infor->product_image);
        $product_infor->ProductTypeName = Product::where('product_id',$id)->first()->get_category()->first()->get_producttype()->first()->product_type_name;
        $product_infor->CategoryName = Product::where('product_id',$id)->first()->get_category()->first()->product_category_name;
        return view('editproduct',['title' => $this->title, 'ProductTypes' => $ProductTypes,'product_infor' => $product_infor]);
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
        $request->validate([
            'ProductName' => 'required|max:200',
            'Productprice' => 'required|numeric|max:1000000000|min:1',
            'ProductType' => 'required',
            'ProductCategory' => 'required',
            'Description' => 'max:200',
            'ProductImage' => "bail|required",
            'ProductImage.*' => 'bail|image|mimes:jpg,png,jpeg|max:2048'
        ], [
            'ProductName.required' => "Vui lòng nhập tên sản phẩm",
            'ProductName.unique' => "Tên đã tồn tại vui lòng nhập tên khác",
            'ProductName.max' => 'Tên dài hơn 200 kí tự vui lòng nhập lại',
            'Productprice.required' => "Vui lòng nhập giá của sản phẩm",
            'Productprice.min'      => "vui lòng nhập giá sản phẩm theo thực tế",
            'Productprice.max' => "Vui lòng nhập giá sản phẩm có số kí tự nhỏ hơn 10",
            'Productprice.numeric' => "Vui lòng nhập giá sản phẩm bằng số",
            'ProductType.required' => "Vui lòng chọn loại sản phẩm",
            'ProductCategory.required' => "Vui lòng chọn danh mục sản phẩm",
            'Description.max' => 'Vui lòng nhập description nhỏ hơn 200 kí tự',
            'ProductImage.required' => 'Vui lòng upload ảnh sản phẩm 1',
            'ProductImage.*.image'   => "vui lòng upload file ảnh",
            'ProductImage.*.mimes'   => "vui lòng upload file .jpg, .jpeg ,.png",
        ]);

        $product = Product::where('product_id', $id)->first();

        echo $product;
        
        $imagelinks = "";
        if ($request->hasfile('ProductImage')){
            foreach ($request->file('ProductImage') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/ProductImage/', $name);
                $imagelinks .= $name . ",";
            }
            $product->product_image = $imagelinks;
            $product->product_category_id  = $request->ProductCategory;
            $product->product_name = $request->ProductName;
            $product->product_price = $request->Productprice;
            $product->product_description =  $request->Description;
            $product->save();
        }
        return back()->with('success', 'Edit sản phẩm thành công !');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product_image = explode(",",$product->product_image);
        foreach($product_image as $item){
            if(!empty($item)){
                unlink(public_path() . '/ProductImage/'.$item);
            }
        }
        $product->delete();
        return back()->with('success', 'Đã xóa  sản phẩm thành công !');
    }
}
