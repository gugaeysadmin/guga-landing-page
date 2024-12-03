<?php

namespace App\View\Components;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;

class SpecialityAreaController extends Controller
{
    /**
     * Get the view / contents that represents the component.
     */
    public function index()
    {
        return view('speciality-area');
    }
}
