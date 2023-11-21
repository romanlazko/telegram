<?php

namespace Romanlazko\Telegram\Traits;

use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\TelegramChat;

trait HasBots
{
    public function telegram_bots()
    {
        return $this->hasMany(TelegramBot::class, 'owner_id', 'id');
    }
}