<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AuthForm extends Component
{
    public $type = '';
    public $buttonName = '';
    /**
     * Create a new component instance.
     */
    public function __construct($type='login', $buttonName='Log in')
    {
        $this->type = $type;
        $this->buttonName = $buttonName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth-form');
    }
}
