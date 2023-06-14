<?php 

namespace Romanlazko\Telegram\App\Commands\DefaultCommands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Update;

// Send update like pretty string, in case the transmitted command is not on this list, return Update like string 

class SendResultCommand extends Command
{
    public static $command = 'send_result';

    public static $usage = [
        'send_result',
        '/default'
    ];

    protected $enabled = true;

    public function execute(Update $updates)
    {
        $data = [
            'text'                  => $updates->getPrettyString(),
            'chat_id'               => $updates->getChat()->getId(),
            'message_id'            => $updates->getCallbackQuery()?->getMessage()->getMessageId(),
            'message_thread_id'     => $updates->getCallbackQuery()?->getMessage()?->getMessageThreadId() ?? $updates->getMessage()?->getMessageThreadId(),
        ];
        
        return BotApi::sendMessage($data);
    }
}
