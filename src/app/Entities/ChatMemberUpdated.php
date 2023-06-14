<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\ChatMember\ChatMember;

/**
 * Class ChatMemberUpdated
 *
 * Represents changes in the status of a chat member
 *
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 *
 * @method Chat            getChat()              Chat the user belongs to
 * @method User            getFrom()              Performer of the action, which resulted in the change
 * @method int             getDate()              Date the change was done in Unix time
 * @method ChatMember      getOldChatMember()     Previous information about the chat member
 * @method ChatMember      getNewChatMember()     New information about the chat member
 * @method ChatInviteLink  getInviteLink()        Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
 */
class ChatMemberUpdated extends BaseEntity
{
    static $map = [
        'chat'              => Chat::class,
        'from'              => User::class,
        'date'              => true,
        'old_chat_member'   => ChatMember::class,
        'new_chat_member'   => ChatMember::class,
        'invite_link'       => ChatInviteLink::class,
    ];
}