<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpecAreaButton extends Component
{
    public $href;
    public $text;
    public $image;

    public function __construct($href, $text, $image)
    {
        $this->href = $href;
        $this->text = $text;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spec-area-button');
    }
}
