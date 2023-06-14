<?php

namespace Romanlazko\Telegram\App\Entities\ChatMember;

use Romanlazko\Telegram\App\Entities\BaseEntity;
use Romanlazko\Telegram\App\Entities\User;

/**
 * Class ChatMemberNotImplemented
 *
 * @method string getStatus() The member's status in the chat
 * @method User   getUser()   Information about the user
 */
class ChatMemberNotImplemented extends BaseEntity
{
    public static $map = [
        'status'                    => true,
        'user'                      => User::class,
    ];
}