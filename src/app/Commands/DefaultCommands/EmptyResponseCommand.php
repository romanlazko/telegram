<?php 
namespace Romanlazko\Telegram\App\Commands\DefaultCommands;

use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;

class EmptyResponseCommand extends Command
{
    public static $command = 'empty_response';

    public static $usage = [
        '/default',
        'default',
        'channel_post', 
        'edited_message', 
        'edited_channel_post', 
        'inline_query', 
        'chosen_inline_result', 
        'shipping_query',
        'pre_checkout_query',
        'poll',
        'poll_answer',
        'my_chat_member',
        'chat_member',
        'chat_join_request',
    ];

    protected $enabled = true;

    public function execute(Update $updates)
    {
        return Response::fromRequest(['ok' => true]);
    }




}