<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpateProductTypRequest extends FormRequest
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
        return [
            'ProductType' => 'required|unique:product_type,product_type_name|max:100',
        ];
    }
    public function messages()
    {
        return [
            'ProductType.required' => "Vui lòng nhập loại sản phẩm",
            'ProductType.unique' => "Tên loại sản phẩm đã tồn tại. Vui lòng nhập tên khác",
            'ProductType.max'  => "Vui lòng nhập tên loại sản phẩm dài dưới 100 ký tự"
        ];
    }
}
