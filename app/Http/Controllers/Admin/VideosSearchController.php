<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Media\Video;
use Illuminate\Http\Request;

class VideosSearchController extends Controller
{
    public function index()
    {
        $query = request('q');

        if(!$query) {
            return [];
        }

        return Video::where('title', 'LIKE', "%{$query}%")->get();
    }
}
