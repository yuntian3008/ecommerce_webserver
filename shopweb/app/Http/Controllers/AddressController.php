<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address' => ['string', 'max:255'],
            'province' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'phone_number' => ['regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/']
        ]);

        $address = $request->user()->addresses()->create($request->all());

        return response()->json($address, Response::HTTP_OK);
    }
}
