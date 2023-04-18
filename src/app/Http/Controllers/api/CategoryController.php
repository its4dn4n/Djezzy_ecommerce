<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\categories\CreateCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $result = Category::all();
         return $this->responseSuccess(CategoryResource::collection( $result ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
         $request_array= $request->validated();
         Category::create($request_array);
         return $this->responseSuccess(null);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category) 
    {
 
        $category= Category::find($category);
        if (!empty($category))
           return $this->responseSuccess(  new CategoryResource($category)  );
        return $this->responseError(null, 'Category not found.', 404); 

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,string $category) 
    {   
        $category= Category::find($category);
        if (!empty($category)){
            $request_array= $request->validated();
            $category->update(['name'=>$request_array['name']]); 
            return $this->responseSuccess(new CategoryResource($category));
        }
        return $this->responseError(null, 'Category not found.', 404);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) 
    { 
        $deleted= $category->delete();
        if (!$deleted)
           return $this->responseError(null, 'Failed to delete the category.', 500);
        return $this->responseSuccess('Category Deleted Succefully');
    }
}
