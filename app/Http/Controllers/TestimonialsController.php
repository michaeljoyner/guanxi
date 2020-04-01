<?php

namespace App\Http\Controllers;

use App\Testimonials\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::forLocale()->public()->latest()->get()->map->toArray();

        return view('front.testimonials.index', ['testimonials' => $testimonials]);
    }
}
