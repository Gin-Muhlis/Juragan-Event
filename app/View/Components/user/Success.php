<?php

namespace App\View\Components\user;

use Illuminate\View\Component;

class Success extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.success', ['message' => $this->message]);
    }
}
