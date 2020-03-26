<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonials\Testimonial;
use Illuminate\Http\Request;

class TestimonialAvatarsController extends Controller
{
    public function store(Testimonial $testimonial)
    {
        $image = $testimonial->setAvatar(request('file'));

        return['src' => $image->getUrl('thumb')];
    }
}
