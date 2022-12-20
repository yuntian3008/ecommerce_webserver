<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $category = $this->route('category');
        $this->merge([
            'slug' => $category->name != $this->name ? Str::slug($this->name,'-','vi') .'-'. Str::random(6) : $category->slug
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $category = $this->route('category');
        return [
            'name' => ['required', 'string', 'max:168'],
            'slug' => ['required', Rule::unique('categories')->ignore($category->id)],
            'desc' => ['nullable', 'string', 'max:5120'],
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
            'name' => 'tên danh mục',
            'desc' => 'mô tả danh mục'
        ];
    }
}
