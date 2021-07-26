<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ProductName' => 'required|max:200',
            'Productprice' => 'required|numeric|integer|max:1000000000|min:1',
            'ProductType' => 'required',
            'ProductCategory' => 'required',
            'Description' => 'max:200',
            'ProductImageUpdate.*' => 'bail|image|mimes:jpg,png,jpeg|max:2048',
        ];

    }
    public function messages()
    {
        return [
            'ProductName.required' => "Vui lòng nhập tên sản phẩm",
            'ProductName.max' => 'Tên dài hơn 200 kí tự vui lòng nhập lại',
            'Productprice.required' => "Vui lòng nhập giá của sản phẩm",
            'Productprice.min'      => "Vui lòng nhập giá sản phẩm theo thực tế",
            'Productprice.integer' => "Vui lòng nhập giá sản phẩm theo mệnh giá VNĐ",
            'Productprice.max' => "Vui lòng nhập giá sản phẩm có số kí tự nhỏ hơn 10",
            'Productprice.numeric' => "Vui lòng nhập giá sản phẩm bằng số",
            'ProductType.required' => "Vui lòng chọn loại sản phẩm",
            'ProductCategory.required' => "Vui lòng chọn danh mục sản phẩm",
            'Description.max' => 'Vui lòng nhập description nhỏ hơn 200 kí tự',
            'ProductImageUpdate.*.image'   => "vui lòng upload file ảnh",
            'ProductImageUpdate.*.mimes'   => "vui lòng upload file .jpg, .jpeg ,.png",
            'ProductImageUpdate.*.max'   => "vui lòng upload file có dung lượng nhỏ hơn 2048 Kb",
        ];
    }
}
