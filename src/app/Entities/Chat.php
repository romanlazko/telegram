<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Chat
 *
 * @link https://core.telegram.org/bots/api#chat
 *
 * @property string type Type of chat, can be either "private ", "group", "supergroup" or "channel"
 *
 * @method int             getId()                                 Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 * @method string          getType()                               Type of chat, can be either "private ", "group", "supergroup" or "channel"
 * @method string          getTitle()                              Optional. Title, for channels and group chats
 * @method string          getUsername()                           Optional. Username, for private chats, supergroups and channels if available
 * @method string          getFirstName()                          Optional. First name of the other party in a private chat
 * @method string          getLastName()                           Optional. Last name of the other party in a private chat
 * @method bool            getIsForum()                            Optional. True, if the supergroup chat is a forum (has topics enabled)
 * @method ChatPhoto       getPhoto()                              Optional. Chat photo. Returned only in getChat.
 * @method string[]        getActiveUsernames()                    Optional. If non-empty, the list of all active chat usernames; for private chats, supergroups and channels. Returned only in getChat.
 * @method string          getEmojiStatusCustomEmojiId()           Optional. Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
 * @method string          getBio()                                Optional. Bio of the other party in a private chat. Returned only in getChat.
 * @method bool            getHasPrivateForwards()                 Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in getChat.
 * @method bool            getHasRestrictedVoiceAndVideoMessages() Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
 * @method bool            getJoinToSendMessages()                 Optional. True, if users need to join the supergroup before they can send messages. Returned only in getChat.
 * @method bool            getJoinByRequest()                      Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators. Returned only in getChat.
 * @method string          getDescription()                        Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
 * @method string          getInviteLink()                         Optional. Chat invite link, for groups, supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat.
 * @method Message         getPinnedMessage()                      Optional. Pinned message, for groups, supergroups and channels. Returned only in getChat.
 * @method ChatPermissions getPermissions()                        Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
 * @method int             getSlowModeDelay()                      Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat.
 * @method int             getMessageAutoDeleteTime()              Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
 * @method bool            getHasProtectedContent()                Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
 * @method string          getStickerSetName()                     Optional. For supergroups, name of group sticker set. Returned only in getChat.
 * @method bool            getCanSetStickerSet()                   Optional. True, if the bot can change the group sticker set. Returned only in getChat.
 * @method int             getLinkedChatId()                       Optional. Unique identifier for the linked chat. Returned only in getChat.
 * @method ChatLocation    getLocation()                           Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
 */

class Chat extends BaseEntity
{
    public $id;

    public $photo = null;

    public $role = null;

    public $referal_id = null;

    public $manager_id = null;

    public $last_response_message_id = null;

    public static $map = [
        'id'	                                    => true,
        'type'	                                    => true,
        'title'	                                    => true,
        'username'                                  => true,
        'first_name'	                            => true,
        'last_name'	                                => true,
        'is_forum'	                                => true,
        'photo'		                                => ChatPhoto::class,
        'active_usernames'		                    => [true],
        'emoji_status_custom_emoji_id'		        => true,
        'bio'		                                => true,
        'has_private_forwards'		                => true,
        'has_restricted_voice_and_video_messages'   => true,
        'join_to_send_messages'		                => true,
        'join_by_request'		                    => true,
        'description'		                        => true,
        'invite_link'		                        => true,
        'pinned_message'		                    => Message::class,
        'permissions'	                            => ChatPermissions::class,	
        'slow_mode_delay'		                    => true,
        'message_auto_delete_time'		            => true,
        'has_aggressive_anti_spam_enabled'		    => true,
        'has_hidden_members'		                => true,
        'has_protected_content'		                => true,
        'sticker_set_name'		                    => true,
        'can_set_sticker_set'		                => true,
        'linked_chat_id'		                    => true,
        'location'                                  => ChatLocation::class,
    ];

    public function getPhotoLink()
    {
        $file_id = $this->photo?->getBigFileId();
        return BotApi::getPhoto(['file_id' => $file_id]);
    }

    public function getId(?int $chat_id = null)
    {
        return $chat_id ?? $this->id;
    }

    public function getLastMessageId()
    {
        return $this->last_response_message_id = DB::getLastMessageId($this->getId());
    }

    public function setRole($role)
    {
        $this->role = DB::setRole($this->getId(), $role);
    }

    public function getRole()
    {
        if ($this->role === null) {
            $this->role = DB::getRole($this->getId());
        }
        return $this->role;
    }

    public function setReferal($referal_id = null) : void
    {
        if (!$this->getReferal()) {
            $this->referal_id = DB::setReferal($this->getId(), $referal_id);
        }
    }

    public function getReferal()
    {
        if ($this->referal_id === null) {
            $this->referal_id = DB::getReferal($this->getId());
        }
        return $this->referal_id;
    }

    public function setManager($manager_id = null) : void
    {
        $this->manager_id = DB::setManager($this->getId(), $manager_id);
    }

    public function getManager()
    {
        if ($this->manager_id === null) {
            $this->manager_id = DB::getManager($this->getId());
        }
        return $this->manager_id;
    }

    public function getContact($parse_mode = 'Markdown')
    {
        if ($this->getUsername()) {
            return "@{$this->getUsername()}";
        } else {
            $contactName = "{$this->getFirstName()} {$this->getLastName()}";

            if ($parse_mode === 'HTML') {
                return "<a href='tg://user?id={$this->getId()}'>{$contactName}</a>";
            }
            return "[tg://user?id={$this->getId()}]({$contactName})";
        }
    }
}