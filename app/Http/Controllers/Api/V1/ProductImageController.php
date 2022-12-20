<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $product->category;
        $product->product_images = $product->productImages()->orderByRaw('ISNULL(priority), priority ASC')->get();
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductImageRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductImageRequest $request, Product $product)
    {
        $imageManager = new ImageManager();

        $image = $imageManager->make($request->safe()->image)->widen(800, function ($constraint) {
            $constraint->upsize();
        })->encode('jpg');

        Storage::disk('product-image')->put($request->safe()->path,$image);

        $productImage = $product->productImages()->create($request->safe()->except('image'));

        // var_dump([$image->mime(),$imageName,Storage::disk('product-image')->url($imageName)]);

        return response()->json($productImage, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductImageRequest  $request
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductImageRequest $request, Product $product, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImage $productImage)
    {
        Storage::disk('product-image')->delete($productImage->path);
        $productImage->delete();
        return response()->json($productImage, Response::HTTP_OK);
    }
}
