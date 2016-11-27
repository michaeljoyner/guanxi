<?php

namespace App\Http\Controllers\Admin;

use App\Affiliates\Affiliate;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AffiliateImageController extends Controller
{
    public function store(ImageUploadRequest $request, Affiliate $affiliate)
    {
        return $affiliate->setImage($request->file('file'));
    }
}
