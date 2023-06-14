<?php

namespace Romanlazko\Telegram\App\Entities\ChatMember;

use Romanlazko\Telegram\App\Entities\BaseEntity;
use Romanlazko\Telegram\App\Entities\User;

/**
 * Class ChatMemberMember
 *
 * @link https://core.telegram.org/bots/api#chatmembermember
 *
 * @method string getStatus() The member's status in the chat, always “member”
 * @method User   getUser()   Information about the user
 */
class ChatMemberMember extends BaseEntity
{
    public static $map = [
        'status'                    => true,
        'user'                      => User::class,
    ];
}