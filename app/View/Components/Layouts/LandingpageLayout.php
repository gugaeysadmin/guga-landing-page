<?php

namespace App\View\Components\Layouts;

use Illuminate\View\View;
use Illuminate\View\Component;

class LandingpageLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $imagelist  = [
            ['image' => asset('img/img1.jpg'), 'description' => 'imagen 1'],
            ['image' => asset('img/img2.jpg'), 'description' => 'imagen 2'],
            ['image' => asset('img/img3.jpg'), 'description' => 'imagen 3'],
            ['image' => asset('img/img4.jpg'), 'description' => 'imagen 4'],
        ];
        
        return view('layouts.landingpage');
    }
}
