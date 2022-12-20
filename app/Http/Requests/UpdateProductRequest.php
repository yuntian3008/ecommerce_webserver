<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $product = $this->route('product');
        $this->merge([
            'slug' => $product->name != $this->name ? Str::slug($this->name,'-','vi') .'-'. Str::random(6) : $product->slug
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $product = $this->route('product');
        return [
            'category_id' => ['nullable','exists:categories,id'],
            'name' => ['required', 'string', 'max:168'],
            'slug' => ['required', Rule::unique('products')->ignore($product->id)],
            'desc' => ['required', 'string', 'max:5120'],
            'specs' => ['required', 'json'],
            'unit_price' => ['required','numeric','min:0']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'slug.unique' => 'Trùng slug hi hữu, vui lòng thử lại sau',
            'category_id' => 'Danh mục không tồn tại'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'tên sản phẩm',
            'desc' => 'mô tả sản phẩm',
            'specs' => 'thông số sản phẩm',
            'unit_price' => 'đơn giá sản phẩm'
        ];
    }
}
