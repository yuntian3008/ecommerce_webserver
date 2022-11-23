<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category');

Route::get('/search', [HomeController::class,'search'])->name('search');

Route::get('/cart',[ CartController::class, 'index'])->name('cart');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/checkout', [ CheckoutController::class, 'index'])->name('checkout');
    Route::post('/address', [ AddressController::class, 'store'])->name('address.store');

    Route::post('/addresses/{address}/orders',[ OrderController::class, 'store'])->name('order.store');

    Route::get('/orders/{order}', [ OrderController::class, 'show'])->name('order.show');
    Route::get('/orders', [ OrderController::class, 'index'])->name('order.index');



});



