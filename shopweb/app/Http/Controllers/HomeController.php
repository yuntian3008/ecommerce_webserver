<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexHomeShopRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(IndexHomeShopRequest $request)
    {
        $products = Product::paginate(4);
        return Inertia::render('Shop/Home',[
            'products' => $products,
            'home-header-svg' => asset('dev_assets/home_header.svg'),
        ]);
    }
}
