<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $state = $this->state;

        if ($state != null)
            switch ($state) {
                case 0:
                    return $this->user('api')->where(function ($query) {
                        $query->whereRelation('administratorScopes', 'scope', 'cancel-orders');
                        $query->orWhereRelation('administratorScopes', 'scope', '*');
                    })->count() > 0 ? true : false;
                    break;
                // case 1:
                //     return $this->user('api')->where(function ($query) {
                //         $query->whereRelation('administratorScopes', 'scope', 'cancel-orders');
                //     })->count() > 0 ? true : false;
                //     break;
                case 2:
                    return $this->user('api')->where(function ($query) {
                        $query->whereRelation('administratorScopes', 'scope', 'approve-orders');
                        $query->orWhereRelation('administratorScopes', 'scope', '*');
                    })->count() > 0 ? true : false;
                    break;
                case 3:
                    return $this->user('api')->where(function ($query) {
                        $query->whereRelation('administratorScopes', 'scope', 'package-orders');
                        $query->orWhereRelation('administratorScopes', 'scope', '*');
                    })->count() > 0 ? true : false;
                    break;
                case 4:
                    return $this->user('api')->where(function ($query) {
                        $query->whereRelation('administratorScopes', 'scope', 'ship-orders');
                        $query->orWhereRelation('administratorScopes', 'scope', '*');
                    })->count() > 0 ? true : false;
                    break;
                case 5:
                    return $this->user('api')->where(function ($query) {
                        $query->whereRelation('administratorScopes', 'scope', 'to-complete-orders');
                        $query->orWhereRelation('administratorScopes', 'scope', '*');
                    })->count() > 0 ? true : false;
                    break;

                default:
                    return true;
                    break;
            }


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
            'state' => ['nullable', 'in:0,2,3,4,5']
        ];
    }
}
