<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TestimonialCard extends Component
{

    public $testimonial;
    public $isLeft;

    public function __construct($testimonial, $isLeft)
    {
        $this->testimonial = $testimonial;
        $this->isLeft = $isLeft;
    }


    public function render()
    {
        return view('components.testimonial-card');
    }

    public function baseMargin()
    {
        return $this->isLeft ? 'mr-auto' : 'ml-auto';
    }

    public function imageClasses()
    {
        return $this->isLeft ? 'left-0' : 'right-0';
    }

    public function contentClasses()
    {
        return $this->isLeft ? 'pl-10 pr-6' : 'pr-10 pl-6';
    }

    public function nameClasses()
    {
        return $this->isLeft ? 'text-right' : 'text-left';
    }
}
