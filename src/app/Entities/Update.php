<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Update
 *
 * @method int                 getUpdateId()           The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order.
 * @method Message             getMessage()            Optional. New incoming message of any kind — text, photo, sticker, etc.
 * @method Message             getEditedMessage()      Optional. New version of a message that is known to the bot and was edited
 * @method Message             getChannelPost()        Optional. New post in the channel, can be any kind — text, photo, sticker, etc.
 * @method Message             getEditedChannelPost()  Optional. New version of a post in the channel that is known to the bot and was edited
 * @method InlineQuery         getInlineQuery()        Optional. New incoming inline query
 * @method ChosenInlineResult  getChosenInlineResult() Optional. The result of an inline query that was chosen by a user and sent to their chat partner.
 * @method CallbackQuery       getCallbackQuery()      Optional. New incoming callback query
 * @method ShippingQuery       getShippingQuery()      Optional. New incoming shipping query. Only for invoices with flexible price
 * @method PreCheckoutQuery    getPreCheckoutQuery()   Optional. New incoming pre-checkout query. Contains full information about checkout
 * @method Poll                getPoll()               Optional. New poll state. Bots receive only updates about polls, which are sent or stopped by the bot
 * @method PollAnswer          getPollAnswer()         Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
 * @method ChatMemberUpdated   getMyChatMember()       Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @method ChatMemberUpdated   getChatMember()         Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
 * @method ChatJoinRequest     getChatJoinRequest()    Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
 * @method InlineData          getInlineData()         Optional. Inline data geted from CallbackQuery
 */

class Update extends BaseEntity
{
    public static $map = [
        'update_id'            => true,
        'message'              => Message::class,
        'edited_message'       => EditedMessage::class,
        'channel_post'         => Message::class,
        'edited_channel_post'  => EditedChannelPost::class,
        // 'inline_query'         => InlineQuery::class,
        // 'chosen_inline_result' => ChosenInlineResult::class,
        'callback_query'       => CallbackQuery::class,
        // 'shipping_query'       => ShippingQuery::class,
        // 'pre_checkout_query'   => PreCheckoutQuery::class,
        'poll'                 => Poll::class,
        // 'poll_answer'          => PollAnswer::class,
        'my_chat_member'       => ChatMemberUpdated::class,
        'chat_member'          => ChatMemberUpdated::class,
        'chat_join_request'    => ChatJoinRequest::class,
    ];

    public function getInlineData()
    {
        return $this->getCallbackQuery()?->getData() ?? InlineData::fromRequest();
    }

    public function getFrom()
    {
        $object = $this->getProperty($this->getUpdateType());

        return $object?->getFrom();
    }

    public function getChat()
    {
        $object = $this->getProperty($this->getUpdateType());

        return $object?->getMessage()?->getChat() ?? $object?->getChat();
    }

    public function getChatId(?int $chat_id = null)
    {
        return $chat_id ?? $this->getChat()?->getId();
    }

    /**
     * Get the update type based on the set properties
     *
     * @return string|null
     */
    public function getUpdateType(): ?string
    {
        foreach (self::$map as $type => $value) {
            if ($value !== true) {
                if ($this->getProperty($type)) {
                    return $type;
                }
            }
        }

        return null;
    }
}