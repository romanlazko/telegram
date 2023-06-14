<?php 

namespace Romanlazko\Telegram\App\Commands\UserCommands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Update;

class HelpCommand extends Command
{
    public static $command = 'help';

    public static $usage = ['help', '/help'];

    protected $enabled = true;

    public function execute(Update $updates)
    {
        $data = [
            'text'      => "It is a default *help* command.",
            'chat_id'   => $updates->getChat()->getId(),
            'parse_mode' => "Markdown",
        ];

        return BotApi::sendMessage($data);
    }




}
