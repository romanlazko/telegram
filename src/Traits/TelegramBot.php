<?php

namespace Romanlazko\Telegram\Traits;

use Romanlazko\Telegram\Models\Bot;
use Romanlazko\Telegram\Models\TelegramChat;
use Romanlazko\Telegram\Models\UserHasBot;

trait TelegramBot
{
    public function bot()
    {
        return $this->hasOne(Bot::class);
    }

    public function chat()
    {
        return $this->hasOne(TelegramChat::class, 'chat_id', 'chat_id');
    }

    public function referalChats()
    {
        return $this->hasMany(TelegramChat::class, 'referal_id', 'chat_id');
    }

    public function managerChats()
    {
        return $this->hasMany(TelegramChat::class, 'manager_id', 'chat_id');
    }
}