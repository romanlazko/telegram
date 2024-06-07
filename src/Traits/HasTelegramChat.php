<?php

namespace Romanlazko\Telegram\Traits;

use Romanlazko\Telegram\Models\TelegramChat;

trait HasTelegramChat
{
    public function chat()
    {
        return $this->hasOne(TelegramChat::class, 'telegram_chat_id', 'id');
    }
}