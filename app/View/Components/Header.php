<?php

namespace App\View\Components;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public function render()
    {
        $pages = [
            ['name' => 'menu1', 'to' => 'to'],
            ['name' => 'menu2', 'to' => 'to'],
            ['name' => 'menu3', 'to' => 'to'],
            ['name' => 'menu4', 'to' => 'to'],
            ['name' => 'menu3', 'sublinks' => [
                ['name' => 'submenu1', 'to' => 'to1'],
                ['name' => 'submenu2', 'to' => 'to2'],
                ['name' => 'submenu3', 'to' => 'to3'],
            ]]
        ];
       return view('components.header',['pages' => $pages]);
    }
}
