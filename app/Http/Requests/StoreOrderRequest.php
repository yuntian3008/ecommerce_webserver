<?php

namespace App\Http\Requests;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $address = Address::find($this->route('address'));

        return $address && $this->user()->addresses->find($address);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order_items' => [
                'required', 'array'
            ],
            'order_items.*.id' => ['required','exists:products,id'],
            'order_items.*.quantity' => ['required', 'numeric', 'min:1']
        ];
    }
}
