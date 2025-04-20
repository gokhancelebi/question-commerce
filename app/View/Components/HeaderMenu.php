<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;

class HeaderMenu extends Component
{
    public $pages;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pages = Page::where('is_active', true)
            ->whereIn('slug', ['hakkimizda', 'nasil-calisir', 'iletisim'])
            ->orderBy('order')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-menu');
    }
} 