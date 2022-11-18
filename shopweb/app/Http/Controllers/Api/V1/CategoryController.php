<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
        $this->middleware(['scope:read-categories,*'])->only(['index','show']);
        $this->middleware(['scope:create-categories,*'])->only('store');
        $this->middleware(['scope:update-categories,*'])->only('update');
        $this->middleware(['scope:delete-categories,*'])->only('destroy');
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
            'all' => ['nullable', 'boolean']
        ]);


        if(request()->get('all', false)) {
            return response()->json(Category::all(), Response::HTTP_OK);
        }

        $numOfPage = 5;
        $search = request('s');
        if ($search)
            $category = Category::where('name','like',"%{$search}%")
            ->orWhere('desc','like',"%{$search}%")
            ->paginate($numOfPage);
        else
            $category = Category::paginate($numOfPage);

        $category->withQueryString();
        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category, Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
         return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return response()->json($category, Response::HTTP_OK);
    }
}
