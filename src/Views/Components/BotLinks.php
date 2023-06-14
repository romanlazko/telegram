<?php

namespace Romanlazko\Telegram\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BotLinks extends Component
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
        if ($bot_username = auth()->user()->bot?->username) {
            $componentName = $bot_username.'::components.links';
    
            if (view()->exists($componentName)) {
                return view($componentName);
            }
        }

        return null;
    }
}
