<?php

namespace Romanlazko\Telegram\App\Entities\ChatMember;

use Romanlazko\Telegram\App\Entities\BaseEntity;
use Romanlazko\Telegram\App\Entities\User;

/**
 * Class ChatMemberBanned
 *
 * @link https://core.telegram.org/bots/api#chatmemberbanned
 *
 * @method string getStatus()    The member's status in the chat, always “kicked”
 * @method User   getUser()      Information about the user
 * @method int    getUntilDate() Date when restrictions will be lifted for this user; unix time
 */
class ChatMemberBanned extends BaseEntity
{
    public static $map = [
        'status'                    => true,
        'user'                      => User::class,
        'until_date'                => true,
    ];
}