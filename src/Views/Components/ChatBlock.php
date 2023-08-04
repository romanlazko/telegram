<?php

namespace Romanlazko\Telegram\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Models\TelegramChat;

class ChatBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private TelegramChat $chat, private Telegram $telegram)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|null
    {
        $this->chat->photo = $this->telegram::getPhoto(['file_id' => $this->chat->photo]);
        
        return view('telegram::components.chat.card', ['chat' => $this->chat]);
    }
}
