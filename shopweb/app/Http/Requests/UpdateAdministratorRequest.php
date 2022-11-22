<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdministratorRequest extends FormRequest
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
        return [
            'name' => ['nullable','filled', 'string', 'max:168'],
            'role' => ['nullable','filled', 'string', 'max:168'],
            // 'email' => ['required', 'email' ,Rule::unique('administrators')->ignore($this->email,'email'),'max:254'],
            // 'username' => ['required', 'alpha_num',Rule::unique('administrators')->ignore($this->username,'username'), 'max:254'],
            'password' => ['nullable','in:1,'],
            'block' => ['nullable','boolean']
        ];
    }
}
