<?php

namespace Romanlazko\Telegram\App\Entities\ChatMember;

use Romanlazko\Telegram\App\Entities\BaseEntity;

class ChatMember extends BaseEntity
{
    public static function fromRequest($data)
    {
        $type = [
            'creator'       => ChatMemberOwner::class,
            'administrator' => ChatMemberAdministrator::class,
            'member'        => ChatMemberMember::class,
            'restricted'    => ChatMemberRestricted::class,
            'left'          => ChatMemberLeft::class,
            'kicked'        => ChatMemberBanned::class,
        ];

        if (!isset($type[$data['status'] ?? ''])) {
            return ChatMemberNotImplemented::fromRequest($data);
        }

        $class = $type[$data['status']];
        return $class::fromRequest($data);
    }
}