<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BuyACoffee extends Component
{

    public function __construct(public string $mode = 'dark', public bool $useSupportMessage = true, public bool $patreon = false)
    {}


    public function render()
    {
        return view('components.buy-a-coffee');
    }

    public function buttonType($classes): string
    {
        return $this->mode === 'dark' ? 'type-h3 rounded border-2 border-black text-black px-4 py-2 transition-transform duration-300 ease-in-out transform inline-block text-center' . " " .  $classes: 'btn-white';
    }

    public function svgColour(): string
    {
        return $this->mode === 'dark' ? 'text-black' : 'text-white';
    }

    public function supportMessageClasses(): string
    {
        return $this->mode === 'dark' ? 'text-text-grey' : 'text-white';
    }
}
