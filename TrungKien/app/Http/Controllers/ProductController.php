 
 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use App\Http\Requests\StoreAndUpdateProductRequest;
use Illuminate\Support\Str;
use Image;
use ImageSize;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $products= Product::orderBy('created_at', 'DESC')->paginate(10);
        $currentPage = $products->toArray()['current_page'];
        $perPage = $products->toArray()['per_page'];
        return view('product', ['products' => $products, 'index' => $perPage * ($currentPage - 1) + 1, 'title' => $this->title]);
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
    public function store(StoreAndUpdateProductRequest $request)
    {
        $request->validated();
        $product = new Product;
        // resize image demension and save image name
        $product->product_image = $this->resize($request, 'ProductImage');
        $product->product_category_id  = $request->ProductCategory;
        $product->product_id =  Str::random(5);
        $product->product_name = ucfirst($request->ProductName);
        $product->product_price = $request->Productprice;
        $product->product_description = ucfirst($request->Description);
        $product->save();
        return back()->with('success', 'Thêm mới sản phẩm thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dung orm
        $productInfor =  Product::where('product_id', $id)->first();
        return view('detailproduct', ['title' => $this->title, 'productInfor' => $productInfor]);
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
        $productInfor = Product::where('product_id', $id)->first();
        return view('editproduct', ['title' => $this->title, 'ProductTypes' => $ProductTypes, 'productInfor' => $productInfor]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateProductRequest $request, $id)
    {
        $request->validated();
        $product = Product::where('product_id', $id)->first();
        $product->product_image = $this->resize($request, 'ProductImage');
        $product->product_category_id  = $request->ProductCategory;
        $product->product_name = ucfirst( $request->ProductName);
        $product->product_price = $request->Productprice;
        $product->product_description = ucfirst($request->Description);
        $product->save();
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
        foreach ($product->product_image as $item) {
            if (!empty($item)) {
                unlink(public_path() . '/ProductImage/' . $item);
            }
        }
        $product->delete();
        return back()->with('success', 'Đã xóa  sản phẩm thành công !');
    }

    // function to settle when ajax call to get ProductType

    public function productType(Request $request)
    {
        $categories =  ProductType::where('product_type_name', $request->category)->first()->categories;
        return json_encode($categories, JSON_UNESCAPED_UNICODE);
    }

    // function to resize image when user uploaded

    public function resize($request, $name)
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
