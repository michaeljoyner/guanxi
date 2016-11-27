<?php

namespace App\Http\Controllers\Admin\Api;

use App\Content\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        return Category::all()->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->getTranslation('name', 'en')
            ];
        })->toArray();
    }
}
