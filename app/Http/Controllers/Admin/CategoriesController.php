<?php

namespace App\Http\Controllers\Admin;

use App\Content\Category;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\CategoryForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

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

        $this->flasher->success('Category Added', 'Time to get writing');

        return redirect('/admin/content/categories/' . $category->id);
    }

    public function update(CategoryForm $request, Category $category)
    {
        $category->updateWithTranslations($request->requiredAttributes());

        $this->flasher->success('Category Updated', 'Your changes have been saved');

        return redirect('/admin/content/categories/' . $category->id);
    }

    public function delete(Category $category)
    {
        $category->delete();

        $this->flasher->success('Category Deleted', 'All things must end');

        return redirect('/admin/content/categories');
    }
}
