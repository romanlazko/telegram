<?php 

namespace Romanlazko\Telegram\App\Commands\UserCommands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Update;

class StartCommand extends Command
{
    public static $command = 'start';

    public static $usage = ['start', '/start'];

    protected $enabled = true;

    public function execute(Update $updates)
    {
        $data = [
            'text'      => "It is default *start* command.",
            'chat_id'   => $updates->getChat()->getId(),
            'parse_mode' => "Markdown",
        ];

        return BotApi::sendMessage($data);
    }
}
