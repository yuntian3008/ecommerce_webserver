<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AdministratorScopeController;
use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use Laravel\Passport\Passport;

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

// Route::post('/test/them', function(Request $request) {
//     Category::create($request->all());
//     // dd($request->name);
// });

// Route::patch('/test/capnhat/{id}', function(Request $request, $id) {
//     $category = Category::find($id);
//     $category->products;
//     $category->update($request->all());
// });


// Route::get('/test/xem', function(Request $request) {
//     $data = Category::all();
//     dd($data);
// });


Route::prefix('/content')->group(function () {
    Route::resources([
        'categories' => CategoryController::class,
    ]);
});

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class,'login']);
    Route::get('/user', [AuthController::class,'user']);
    Route::post('/logout',[AuthController::class,'logout']);


    Route::get('/scope-test', function() {
    });
    Route::resources([
        'administrators.scopes' => AdministratorScopeController::class,
    ]);


});
