<?php

namespace Romanlazko\Telegram\Traits;

use Romanlazko\Telegram\Models\Bot;
use Romanlazko\Telegram\Models\TelegramChat;

trait HasBot
{
    public function bots()
    {
        return $this->hasMany(Bot::class);
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

    public function current()
    {
        return $this->bots()->find(session()->get('current_bot', null));
    }
}