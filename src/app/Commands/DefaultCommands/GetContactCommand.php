<?php 

namespace Romanlazko\Telegram\App\Commands\DefaultCommands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\App\DB;

class GetContactCommand extends Command
{
    public static $command = 'get_contact';

    public static $pattern = "/^(\/start\s)(contact)=(\d+)$/";

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        preg_match($this->pattern, $updates->getMessage()?->getCommand(), $matches);

        $buttons = BotApi::inlineKeyboardWithLink(
            array('text' => 'Контакт', 'url'  => "tg://user?id={$matches[3]}")
        );

        $chat = DB::getChat($matches[3]);

        $text = implode("\n", [
            "*Контакт для связи*"."\n",
            "Имя фамилия: *{$chat->first_name} {$chat->last_name}*"."\n",
            "Имя пользователя: *@{$chat->username}*",
        ]);

        return BotApi::sendMessage([
            'text'          =>  $text,
            'chat_id'       =>  $updates->getChat()->getId(),
            'reply_markup'  =>  $buttons,
            'parse_mode'    =>  'Markdown',
        ]);
    }
}
