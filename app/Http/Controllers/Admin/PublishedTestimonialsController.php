<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonials\Testimonial;
use Illuminate\Http\Request;

class PublishedTestimonialsController extends Controller
{
    public function store()
    {
        $testimonial = Testimonial::findOrFail(request('testimonial_id'));

        $testimonial->publish();
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->retract();
    }
}
