<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPagesController extends Controller
{
    public function show()
    {
        return view('admin.about.show')->with(AboutPage::getContent());
    }
}
