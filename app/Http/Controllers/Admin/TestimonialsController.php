<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\FlashMessaging\Flasher;
use App\Testimonials\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::latest()->get()->map->toArray();
        return view('admin.testimonials.index', ['testimonials' => $testimonials]);
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', ['testimonial' => $testimonial->toArray()]);
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', ['testimonial' => $testimonial->toArray()]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
            'language' => ['required', 'in:en,zh'],
            'content' => ['required'],
        ]);

        $testimonial = Testimonial::create(request()->only('name', 'language', 'content'));

        return ['redirect' => '/admin/testimonials/' . $testimonial->id];
    }

    public function update(Testimonial $testimonial, Flasher $flasher)
    {
        request()->validate([
            'name' => ['required'],
            'language' => ['required', 'in:en,zh'],
            'content' => ['required'],
        ]);
        $testimonial->update(request()->only('name', 'language', 'content'));

        $flasher->success('Testimonial Updated', 'The testimonial has been updated.');

        return redirect('/admin/testimonials/' . $testimonial->id);
    }

    public function delete(Testimonial $testimonial, Flasher $flasher)
    {
        $testimonial->delete();

        $flasher->success('Testimonial Deleted', 'The testimonial has been removed.');

        return redirect('/admin/testimonials');
    }
}
