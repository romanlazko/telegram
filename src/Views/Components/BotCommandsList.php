<?php

namespace Romanlazko\Telegram\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Romanlazko\Telegram\App\Telegram;

class BotCommandsList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Telegram $telegram)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|null
    {
        $commandsList = $this->telegram->getAllCommandsList()['user'];

        foreach ($commandsList as $command) {
            $command = "\\".$command;
            if (class_exists($command) AND $title = $command::getTitle()) {
                $commands[$command] = $title;
            }
        }

        return view('telegram::components.message.commands-list', compact('commands'));
    }
}
