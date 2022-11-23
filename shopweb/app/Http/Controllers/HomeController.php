<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexHomeShopRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(IndexHomeShopRequest $request)
    {
        $products = Product::paginate(8);
        if ($request->wantsJson())
            return $products;

        return Inertia::render('Shop/Home',[
            'products' => $products,
            'home-header-svg' => asset('dev_assets/home_header.svg'),
        ]);
    }

    public function search(IndexHomeShopRequest $request)
    {
        request()->validate([
            's' => ['nullable','string'],
            'pf' => ['nullable','numeric','lt:pt'],
            'pt' => ['nullable','numeric','gt:pf']
        ]);



        $numOfPage = 8;
        $search = request('s');
        $priceFrom = request('pf');
        $priceTo = request('pt');



        $product = Product::query();

        if ($search) {
            $search = strtolower($search);
            $product = $product->where('name','like',"%{$search}%")
            ->where('desc','like',"%{$search}%");


        }

        if ($priceFrom && $priceTo)
            $product = $product->whereBetween('unit_price', [doubleval($priceFrom), doubleval($priceTo)]);

            // dd($product->get());

        // dd($product->toSql());

        $result = $product->paginate($numOfPage);

        $result->withQueryString();

        if ($request->wantsJson())
            return $result;

        return Inertia::render('Shop/Search',[
            'products' => $result,
            'params' => $request->all(),
        ]);
    }

    public function category(Request $request, Category $category) {
        request()->validate([
            's' => ['nullable','string'],
            'pf' => ['nullable','numeric','lt:pt'],
            'pt' => ['nullable','numeric','gt:pf']
        ]);



        $numOfPage = 8;
        $search = request('s');
        $priceFrom = request('pf');
        $priceTo = request('pt');



        $product = $category->products()->getQuery();

        if ($search) {
            $search = strtolower($search);
            $product = $product->where('name','like',"%{$search}%")
            ->where('desc','like',"%{$search}%");


        }

        if ($priceFrom && $priceTo)
            $product = $product->whereBetween('unit_price', [doubleval($priceFrom), doubleval($priceTo)]);

            // dd($product->get());

        // dd($product->toSql());

        $result = $product->paginate($numOfPage);

        $result->withQueryString();

        if ($request->wantsJson())
            return $result;

        return Inertia::render('Shop/Category',[
            'category' => $category,
            'products' => $result,
            'params' => $request->all(),
        ]);
    }
}
