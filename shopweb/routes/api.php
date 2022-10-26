<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/test/them', function(Request $request) {
    Category::create($request->all());
    // dd($request->name);
});

Route::patch('/test/capnhat/{id}', function(Request $request, $id) {
    $category = Category::find($id);
    $category->products;
    $category->update($request->all());
});


Route::get('/test/xem', function(Request $request) {
    $data = Category::all();
    dd($data);
});
