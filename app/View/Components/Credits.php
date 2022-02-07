<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Votes;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Credits extends Component
{
    public $post;
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.credits');
    }
}
