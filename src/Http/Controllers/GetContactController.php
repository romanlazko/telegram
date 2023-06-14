<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Models\TelegramChat;

class GetContactController extends Controller
{
    public function __invoke(TelegramChat $chat = null, Telegram $telegram)
    {
        try {
            $buttons = $telegram::inlineKeyboardWithLink(
                array('text' => 'Контакт', 'url'  => "tg://user?id={$chat->chat_id}")
            );
    
            $text = implode("\n", [
                "*Контакт для связи*"."\n",
                "Имя фамилия: *{$chat->first_name} {$chat->last_name}*"."\n",
                "Имя пользователя: *@{$chat->username}*",
            ]);
    
            $telegram::sendMessage([
                'text'          =>  $text,
                'chat_id'       =>  auth()->user()->chat_id,
                'reply_markup'  =>  $buttons,
                'parse_mode'    =>  'Markdown',
            ]);

            return redirect("tg://resolve?domain={$telegram->getBotChat()->getUsername()}");
        }
        catch (TelegramException $e) {
            return back()->with([
                'ok' => false, 
                'description' => $e->getMessage()
            ]);
        }
    }
}
