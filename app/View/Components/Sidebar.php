<?php

namespace App\View\Components;

use App\Models\Mrc;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $mrc;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mrc = Mrc::where('is_active', 1)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
