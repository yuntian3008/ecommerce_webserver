<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');


Route::get('/product/{product:slug}', function (Product $product) {
    // $request->session()->flash('flash.dangerBanner', 'Yay it works!');
    return Inertia::render('Shop/Product',[
        'product' => $product
    ]);
})->name('product');

Route::get('/cart-with-product', function (Request $request)
{
    $cart = $request->ids;

    $productImages = [
        [
            'priority' => 0,
            'url' => fake()->imageUrl(640, 480, 'products', true)
        ],
        [
            'priority' => null,
            'url' => fake()->imageUrl(640, 480, 'products', true)
        ],
        [
            'priority' => null,
            'url' => fake()->imageUrl(640, 480, 'products', true)
        ],
        [
            'priority' => null,
            'url' => fake()->imageUrl(640, 480, 'products', true)
        ],
    ];

    $data = [];

    foreach ($cart as $i => $value) {
        $data[$i]["id"] = $value;
        $data[$i]["name"] = fake()->sentence();
        $data[$i]["desc"] = fake()->paragraph();
        $data[$i]["slug"] =Str::of($data[$i]["name"])->slug('-');
        $data[$i]["specs"] = "[]";
        $data[$i]["unit_price"] = fake()->numberBetween(1000,100000);
        $data[$i]["product_images"] = $productImages;
    }

    return $data;
})->name('cart-with-product');

Route::get('/cart', function (Request $request) {
    // $request->session()->flash('flash.dangerBanner', 'Yay it works!');
    return Inertia::render('Shop/Cart',[
        // 'fullCartItems' => Inertia::lazy(function () {
        //     $cart = request('cart');

        //     $productImages = [
        //         [
        //             'priority' => 0,
        //             'url' => fake()->imageUrl(640, 480, 'products', true)
        //         ],
        //         [
        //             'priority' => null,
        //             'url' => fake()->imageUrl(640, 480, 'products', true)
        //         ],
        //         [
        //             'priority' => null,
        //             'url' => fake()->imageUrl(640, 480, 'products', true)
        //         ],
        //         [
        //             'priority' => null,
        //             'url' => fake()->imageUrl(640, 480, 'products', true)
        //         ],
        //     ];

        //     foreach ($cart as $i => $value) {
        //         $cart[$i]["name"] = fake()->sentence();
        //         $cart[$i]["desc"] = fake()->paragraph();
        //         $cart[$i]["slug"] =Str::of($cart[$i]["name"])->slug('-');
        //         $cart[$i]["specs"] = "[]";
        //         $cart[$i]["unit_price"] = fake()->numberBetween(1000000,100000000);
        //         $cart[$i]["product_images"] = $productImages;
        //     }

        //     return $cart;
        // }),
    ]);
})->name('cart');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');
});



