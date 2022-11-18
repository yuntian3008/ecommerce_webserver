<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class ProductController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
        $this->middleware(['scope:read-products,*'])->only(['index','show']);
        $this->middleware(['scope:create-products,*'])->only('store');
        $this->middleware(['scope:update-products,*'])->only('update');
        $this->middleware(['scope:delete-products,*'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $product = Product::with('productImages');

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
    public function store(StoreProductRequest $request)
    {
        $category = Category::find($request->safe()->category_id);

        $product = $category->products()->create($request->safe()->except('category_id'));
        return response()->json($product, Response::HTTP_OK);
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->category;
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Category  $category
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->whenHas('category_id', function($input) use ($product) {
            $category = Category::find($input);
            $product->category()->associate($category);
        });
        $product->update($request->safe()->except('category_id'));
         return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json($product, Response::HTTP_OK);
    }

}
