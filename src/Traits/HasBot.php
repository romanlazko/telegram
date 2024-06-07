<?php

namespace Romanlazko\Telegram\Traits;

use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\TelegramChat;

trait HasBot
{
    public function bots()
    {
        return $this->hasMany(TelegramBot::class);
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

    public function getBotAttribute()
    {
        return TelegramBot::find(session()->get('current_bot', null));
    }
}