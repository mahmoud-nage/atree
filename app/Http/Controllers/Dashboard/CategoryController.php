<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Dashboard\Categories\StoreCategoryRequest;
use App\Http\Requests\Dashboard\Categories\UpdateCategoryRequest;
use App\Jobs\DeleteImagesFromAWSJob;
class CategoryController extends Controller
{
    

    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create' , compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category;
        if(!$category->add($request->all()))
            return back()->with('error' , trans('categories.adding_error'));

        if($request->hasFile('image')) {
            $category->image = basename($request->file('image')->store('categories'));
            $category->save();
        }
        return redirect(route('dashboard.categories.index'))->with('success' , trans('categories.adding_success'));
    }

    public function show(Category $category)
    {
        $category->load('user');
        return view('dashboard.categories.show' , compact('category'));
    }


    public function edit(Category $category)
    {   
        $categories = Category::all();
        return view('dashboard.categories.edit' , compact('category' , 'categories'));
    }


    public function update(UpdateCategoryRequest $request , Category $category)
    {
        if(!$category->edit($request->all()))
            return back()->with('error' , trans('categories.editing_error'));

        if($request->hasFile('image')) {
            $image = 'categories/'.$category->image;
            DeleteImagesFromAWSJob::dispatch($image);
            $category->image = basename($request->file('image')->store('categories'));
            $category->save();
        }
        return redirect(route('dashboard.categories.index'))->with('success' , trans('categories.editing_success'));
    }
}
