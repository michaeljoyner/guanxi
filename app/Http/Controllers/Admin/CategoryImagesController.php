<?php

namespace App\Http\Controllers\Admin;

use App\Content\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryImagesController extends Controller
{
    public function store(Request $request, Category $category)
    {
        $this->validate($request, ['file' => 'required|image']);

        $image = $category->setImage($request->file('file'));
    }
}
