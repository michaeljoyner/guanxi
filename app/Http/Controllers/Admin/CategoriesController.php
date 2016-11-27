<?php

namespace App\Http\Controllers\Admin;

use App\Content\Category;
use App\Http\Requests\CategoryForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with(compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show')->with(compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with(compact('category'));
    }

    public function store(CategoryForm $request)
    {
        $category = Category::createWithTranslations($request->requiredAttributes());

        return redirect('/admin/content/categories/' . $category->id);
    }

    public function update(CategoryForm $request, Category $category)
    {
        $category->updateWithTranslations($request->requiredAttributes());

        return redirect('/admin/content/categories/' . $category->id);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect('/admin/content/categories');
    }
}
