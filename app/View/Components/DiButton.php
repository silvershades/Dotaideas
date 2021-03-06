<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DiButton extends Component
{
    public $icon;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon,$type)
    {
        $this->icon = $icon;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.di-button');
    }
}
