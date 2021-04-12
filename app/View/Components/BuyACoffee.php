<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BuyACoffee extends Component
{

    public function __construct(public string $mode = 'dark', public bool $useSupportMessage = true)
    {}


    public function render()
    {
        return view('components.buy-a-coffee');
    }

    public function buttonType(): string
    {
        return $this->mode === 'dark' ? 'btn bg-sunny-yellow hover:bg-yellow-400' : 'btn-white';
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
