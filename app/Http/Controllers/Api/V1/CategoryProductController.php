<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryProductController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
        $this->middleware(['scope:read-products,*'])->only('index');
        $this->middleware(['scope:create-products,*'])->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        request()->validate([
            's' => ['nullable','string'],
            'pf' => ['nullable','numeric','lt:pt'],
            'pt' => ['nullable','numeric','gt:pf']
        ]);

        $numOfPage = 5;
        $search = request('s');
        $priceFrom = request('pf');
        $priceTo = request('pt');

        $category->products()->getQuery();

        $product = Product::query();

        if ($search)
            $product->where('name','like',"%{$search}%")
            ->orWhere('desc','like',"%{$search}%");

        if ($priceFrom)
            $product->where('unit_price','>=',$priceFrom);

        if ($priceTo)
            $product->where('unit_price','<=',$priceTo);

        $result = $product->paginate($numOfPage);

        $result->withQueryString();
        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\HTTP\Requests\StoreProductRequest $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, Category $category)
    {
        $product = $category->products()->create($request->safe()->except('category_id'));
        return response()->json($product, Response::HTTP_OK);
    }
}
