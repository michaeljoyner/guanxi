<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesSearchController extends Controller
{
    public function index()
    {
        $query = request('q');

        if(!$query) {
            return [];
        }

        return Article::where('title', 'like', "%{$query}%")->get();
    }
}
