<?php

namespace Romanlazko\Telegram\App\Entities;

/**
 * Class ChatInviteLink
 *
 * Represents an invite link for a chat
 *
 * @link https://core.telegram.org/bots/api#chatinvitelink
 *
 * @method string  getInviteLink()              The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”
 * @method User    getCreator()                 Creator of the link
 * @method bool    getCreatesJoinRequest()      True, if users joining the chat via the link need to be approved by chat administrators
 * @method bool    getIsPrimary()               True, if the link is primary
 * @method bool    getIsRevoked()               True, if the link is revoked
 * @method string  getName()                    Optional. Invite link name
 * @method int     getExpireDate()              Optional. Point in time (Unix timestamp) when the link will expire or has been expired
 * @method int     getMemberLimit()             Optional. Maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
 * @method int     getPendingJoinRequestCount() Optional. Number of pending join requests created using this link
 */
class ChatInviteLink extends BaseEntity
{
    public static $map = [
        'invite_link'                   => true,
        'creator'                       => User::class,
        'creates_join_request'          => true,
        'is_primary'	                => true,
        'is_revoked'	                => true,
        'name'                          => true,
        'expire_date'                   => true,
        'member_limit'                  => true,
        'pending_join_request_count'    => true,
    ];
}