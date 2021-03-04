<?php

namespace App\Http\Controllers;

use App\Pages\AboutPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function show()
    {
        return view('front.contact.page', AboutPage::getContent());
    }
}
