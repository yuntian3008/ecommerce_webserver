<?php

use App\Http\Controllers\TestController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function (Request $request) {
    // $request->session()->flash('flash.dangerBanner', 'Yay it works!');
    return Inertia::render('Home',[
        'carouselImages' => [
            asset('dev_assets/carousel-1.jpg'),
            asset('dev_assets/carousel-2.jpg'),
            asset('dev_assets/carousel-3.jpg'),
        ],
        'home-header-svg' => asset('dev_assets/home_header.svg'),
    ]);
})->name('home');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');
});
