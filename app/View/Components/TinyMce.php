<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinyMce extends Component
{
    public $vmodel;
    public $height;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vmodel,$height)
    {
        $this->vmodel = $vmodel;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tiny-mce');
    }
}
