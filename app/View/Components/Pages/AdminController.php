<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;

class AdminController extends Controller
{
    /**
     * Get the view / contents that represents the component.
     */
    public function index()
    {


        return view('admin');
    }
}
