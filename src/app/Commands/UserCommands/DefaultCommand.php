<?php 

namespace Romanlazko\Telegram\App\Commands\UserCommands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class DefaultCommand extends Command
{
    public static $command = 'default';

    public static $usage = ['default', '/default'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $data = [
            'text'      => "It is *default* command.",
            'chat_id'   => $updates->getChat()->getId(),
            'parse_mode' => "Markdown",
        ];

        return BotApi::sendMessage($data);
    }




}
