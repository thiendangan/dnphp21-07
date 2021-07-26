<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $stopOnFirstFailure = true;
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
        return[
            'categoryName' => 'required|unique:category,product_category_name|max:100',
            'productType' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'categoryName.required' => "Vui lòng nhập danh mục sản phẩm",
            'categoryName.unique' => "Tên danh mục sản phẩm đã tồn tại. Vui lòng nhập tên khác",
            'categoryName.max'  => "Vui lòng nhập tên loại sản phẩm dài dưới 100 ký tự",
            'productType.required' => 'Vui lòng chọn loại sản phẩm'
        ];
    }
}
