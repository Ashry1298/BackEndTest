<?php

namespace App\Http\Controllers\Api\Admin;



use App\Models\Category;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\categories\StoreCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $categories = Category::where('parent_id', null)->paginate(3);

        return $this->successData(CategoryResource::collection($categories));
    }


    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        return $this->successMsg('Category Added Successfully');
    }



    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->successData(new CategoryResource($category));
    }




    public function show(Category $category)
    {
        return $this->successData(new CategoryResource($category));
    }


    public function destroy(Category $category)
    {

        $category->delete();
        return $this->successMsg('Category Deleted Successfully');
    }



}
