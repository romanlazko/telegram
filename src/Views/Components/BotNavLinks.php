<?php

namespace Romanlazko\Telegram\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Romanlazko\Telegram\App\Telegram;

class BotNavLinks extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private ?Telegram $telegram)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|null
    {
        if ($bot_username = $this->telegram?->getBotChat()?->getUsername()) {
            $componentName = $bot_username.'::components.nav-links';
    
            if (view()->exists($componentName)) {
                return view($componentName);
            }
        }

        return null;
    }
}
