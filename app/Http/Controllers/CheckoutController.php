<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Shop/Checkout',[
            'addresses' => $request->user()->addresses
        ]);
    }
}
