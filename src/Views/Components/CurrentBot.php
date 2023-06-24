<?php

namespace Romanlazko\Telegram\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CurrentBot extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|null
    {
        $bot = request()()->user()->bots()->find(session()->get('current_bot', null));

        return $bot->username ?? "+Create bot";
    }
}
