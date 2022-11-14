<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
        $this->middleware(['scopes:read-categories'])->only(['index','show']);
        $this->middleware(['scopes:create-categories'])->only('store');
        $this->middleware(['scopes:update-categories'])->only('update');
        $this->middleware(['scopes:delete-categories'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::paginate(5);

        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:168'],
        ]);
        $request->merge([
            'slug' => Str::slug($request->name,'-','vi') .'-'. Str::random(6)
        ]);
        $request->validate([
            'slug' => ['required','unique:categories'],
            'desc' => ['nullable','string','max:254'],
        ]);
        $category = Category::create($request->only(['name','desc','slug']));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required','string','max:168'],
        ]);
        $request->merge([
            'slug' => $category->name != $request->name ? Str::slug($request->name,'-','vi') .'-'. Str::random(6) : $category->slug
        ]);
        $request->validate([
            'slug' => ['required',Rule::unique('categories')->ignore($category->id)],
            'desc' => ['nullable','string','max:254'],
        ]);
        $category->update($request->only(['name','desc','slug']));
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
