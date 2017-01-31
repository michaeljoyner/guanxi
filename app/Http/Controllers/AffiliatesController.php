<?php

namespace App\Http\Controllers;

use App\Affiliates\Affiliate;
use Illuminate\Http\Request;

use App\Http\Requests;

class AffiliatesController extends Controller
{
    public function index()
    {
        $affiliates = Affiliate::all();

        return view('front.affiliates.index')->with(compact('affiliates'));
    }

    public function show($slug)
    {
        $affiliate = Affiliate::where('slug', $slug)->firstOrFail();
        return view('front.affiliates.show')->with(compact('affiliate'));
    }
}
