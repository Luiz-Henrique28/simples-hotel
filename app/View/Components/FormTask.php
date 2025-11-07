<?php

namespace App\View\Components;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormTask extends Component
{
    /**
     * Create a new component instance.
     */

    public $task;

    public function __construct(?Task $task = null)
    {
        $this->task = $task;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-task');
    }
}
