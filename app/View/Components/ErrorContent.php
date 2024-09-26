<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ErrorContent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $statusCode,
        public $errorMessage,
        public $buttonText,
        public $buttonLink,
        
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-content');
    }
}
