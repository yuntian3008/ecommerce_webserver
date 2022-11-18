<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;

class StoreProductImageRequest extends FormRequest
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
        $path = Str::random(6)."-".time().".jpg";
        $this->merge([
            'path' => $path,
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'image' => ['required','base64image','base64mimes:png,jpg,jpeg','base64dimensions:min_width=800,min_height=800,ratio=1/1','base64max:15360'],
            'path' => ['required'],
            'image' => ['required','image','mimes:png,jpg,jpeg','dimensions:min_width=800,min_height=800,ratio=1/1','max:15360'],
            'priority' => ['nullable','numeric','min:0']
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
            'image' => 'ảnh sản phẩm',
            'priority' => 'mức độ ưu tiên',
        ];
    }
}
