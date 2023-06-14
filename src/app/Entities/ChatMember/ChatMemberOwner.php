<?php

namespace Romanlazko\Telegram\App\Entities\ChatMember;

use Romanlazko\Telegram\App\Entities\BaseEntity;
use Romanlazko\Telegram\App\Entities\User;

/**
 * Class ChatMemberOwner
 *
 * @link https://core.telegram.org/bots/api#chatmemberowner
 *
 * @method string getStatus()      The member's status in the chat, always “creator”
 * @method User   getUser()        Information about the user
 * @method string getCustomTitle() Custom title for this user
 * @method bool   getIsAnonymous() True, if the user's presence in the chat is hidden
 */
class ChatMemberOwner extends BaseEntity
{
    public static $map = [
        'status'                    => true,
        'user'                      => User::class,
        'is_anonymous'              => true,
        'custom_title'              => true,
    ];
}