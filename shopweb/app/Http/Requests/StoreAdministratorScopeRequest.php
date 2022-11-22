<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Passport\Passport;

class StoreAdministratorScopeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $administrator = $this->route('administrator');
        return [
            'scope' => [
                'required',
                Rule::in(Passport::scopeIds()),
                Rule::unique('administrator_scopes')->where(fn ($query) =>
                    $query->where('administrator_id', $administrator->id)
                )
            ],
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
            'scope.unique' => 'Quyền này đã được cấp cho quản trị viên hiện tại',
            'scope.in' => 'Quyền không hợp lệ với hệ thống',
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
            'scope' => 'quyền',
            'desc' => 'mô tả danh mục'
        ];
    }
}
