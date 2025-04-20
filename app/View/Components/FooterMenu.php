<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;

class FooterMenu extends Component
{
    public $pages;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'main')
    {
        $this->type = $type;
        
        if ($type === 'main') {
            $this->pages = Page::where('is_active', true)
                ->whereIn('slug', ['hakkimizda', 'nasil-calisir', 'iletisim'])
                ->orderBy('order')
                ->get();
        } elseif ($type === 'support') {
            $this->pages = Page::where('is_active', true)
                ->whereIn('slug', ['musteri-destegi'])
                ->orderBy('order')
                ->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer-menu');
    }
}
