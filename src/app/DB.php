<?php 
namespace Romanlazko\Telegram\App;

use Romanlazko\Telegram\App\Entities\CallbackQuery;
use Romanlazko\Telegram\App\Entities\Chat;
use Romanlazko\Telegram\App\Entities\ChatJoinRequest;
use Romanlazko\Telegram\App\Entities\ChatMemberUpdated;
use Romanlazko\Telegram\App\Entities\Message;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\App\Entities\User;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\TelegramCallbackQuery;
use Romanlazko\Telegram\Models\TelegramChat;
use Romanlazko\Telegram\Models\TelegramChatJoinRequest;
use Romanlazko\Telegram\Models\TelegramChatMemberUpdate;
use Romanlazko\Telegram\Models\TelegramMessage;
use Romanlazko\Telegram\Models\TelegramUpdate;
use Romanlazko\Telegram\Models\TelegramUser;

/**
 * Provides static helper methods for interacting with the database.
 * 
 * @package App\Telegram
 */

class DB
{
    private function __construct() {}

    /**
     * The Telegram instance to use when interacting with the database.
     * 
     * @var Bot
     */
    static $bot;

    static $telegram_bot = null;

    /**
     * Initializes the DB class with the provided Telegram instance.
     * 
     * @param Telegram $telegram The Telegram instance to use when interacting with the database.
     * 
     * @return void
     */

    static public function initialize(Bot $bot): void
    {
        self::$bot = $bot;
    }

    static public function insertUpdate(Update $update)
    {
        $update = TelegramUpdate::create([
            'update_id'             => $update->getUpdateId(),
            'telegram_bot_id'                => self::getBot()->id,
            'chat'                  => self::insertChatRequest($update->getChat()),
            'message'               => self::insertMessageRequest($update->getMessage()),
            'edited_message'        => self::insertMessageRequest($update->getEditedMessage()),
            'channel_post'          => self::insertMessageRequest($update->getChannelPost()),
            'edited_channel_post'   => self::insertMessageRequest($update->getEditedChannelPost()),
            // 'inline_query'          => $update->getInlineQuery(),
            // 'chosen_inline_result' => $update->getChosenInlineResult(),
            'callback_query'        => self::insertCallbackQueryRequest($update->getCallbackQuery()),
            // 'shipping_query'        => $update->getShippingQuery(),
            // 'pre_checkout_query'    => $update->getPreCheckoutQuery(),
            // 'poll'                  => $update->getPoll(),
            // 'poll_answer'           => $update->getPollAnswer(),
            'my_chat_member'        => self::insertChatMemberUpdatedRequest($update->getMyChatMember()),
            'chat_member'           => self::insertChatMemberUpdatedRequest($update->getChatMember()),
            'chat_join_request'     => self::insertChatJoinRequest($update->getChatJoinRequest()),
        ]);
    }

    static public function insertMessageRequest(?Message $message): ?int
    {
        if ($message === null) {
            return NULL;
        }

        $chat = self::$bot::getChat([
            'chat_id' => $message->getChat()->getId()
        ])->getResult();

        $message = TelegramMessage::create([
            'message_id'                            => $message->getMessageId(),
            'chat'                                  => self::insertChatRequest($chat),
            'message_thread_id'                     => $message->getMessageThreadId(),
            'from'                                  => self::insertUserRequest($message->getFrom()),
            'sender_chat'                           => self::insertChatRequest($message->getSenderChat()),
            'date'                                  => $message->getDate(),
            'forward_from'                          => self::insertUserRequest($message->getForwardFrom()),
            'forward_from_chat'                     => self::insertChatRequest($message->getForwardFromChat()),
            'forward_from_message_id'               => $message->getForwardFromMessageId(),
            'forward_signature'                     => $message->getForwardSignature(),
            'forward_sender_name'                   => $message->getForwardSenderName(),
            'forward_date'                          => $message->getForwardDate(),
            'is_topic_message'                      => $message->getIsTopicMessage(),
            'is_automatic_forward'                  => $message->getIsAutomaticForward(),
            'reply_to_message'                      => self::selectMessage($message->getReplyToMessage())?->id,
            'via_bot'                               => self::insertUserRequest($message->getViaBot()),
            'edit_date'                             => $message->getEditDate(),
            'has_protected_content'                 => $message->getHasProtectedContent(),
            'media_group_id'                        => $message->getMediaGroupId(),
            'author_signature'                      => $message->getAuthorSignature(),
            'text'                                  => $message->getText(),
            'entities'                              => $message->getEntities() ? json_encode($message->getEntities()) : NULL,
            'animation'                             => $message->getAnimation()?->getJson(),
            'audio'                                 => $message->getAudio()?->getJson(),
            'document'                              => $message->getDocument()?->getJson(),
            'photo'                                 => $message->getPhoto(),
            'sticker'                               => $message->getAudio()?->getJson(),
            'video'                                 => $message->getVideo()?->getJson(),
            'video_note'                            => $message->getVideoNote()?->getJson(),
            'voice'                                 => $message->getVoice()?->getJson(),
            'caption'                               => $message->getCaption(),
            'caption_entities'                      => $message->getCaptionEntities() ? json_encode($message->getCaptionEntities()) : NULL,
            'has_media_spoiler'                     => $message->getHasMediaSpoiler(),
            'contact'                               => $message->getContact()?->getJson(),
            'dice'                                  => $message->getDice()?->getJson(),
            'game'                                  => $message->getGame()?->getJson(),
            'poll'                                  => $message->getPoll()?->getJson(),
            'venue'                                 => $message->getVenue()?->getJson(),
            'location'                              => $message->getLocation()?->getJson(),
            'new_chat_members'                      => $message->getNewChatMembers() ? json_encode($message->getNewChatMembers()) : NULL,
            'left_chat_member'                      => self::insertUserRequest($message->getLeftChatMember()),
            'new_chat_title'                        => $message->getNewChatTitle(),
            'new_chat_photo'                        => $message->getNewChatPhoto(),
            'delete_chat_photo'                     => $message->getDeleteChatPhoto(),
            'group_chat_created'                    => $message->getGroupChatCreated(),
            'supergroup_chat_created'               => $message->getSupergroupChatCreated(),
            'channel_chat_created'                  => $message->getChannelChatCreated(),
            'message_auto_delete_timer_changed'     => $message->getMessageAutoDeleteTimerChanged()?->getMessageAutoDeleteTime(),
            'migrate_to_chat_id'                    => $message->getMigrateToChatId(),
            'migrate_from_chat_id'                  => $message->getMigrateFromChatId(),
            'pinned_message'                        => self::selectMessage($message->getPinnedMessage())?->id,
            // 'invoice'                               => $message->getInvoice(),
            // 'successful_payment'                    => $message->getSuccessfulPayment(),
            // 'user_shared'                           => $message->getUserShared(),
            // 'chat_shared'                           => $message->getChatShared(),
            'connected_website'                     => $message->getConnectedWebsite(),
            // 'write_access_allowed'                  => $message->getWriteAccessAllowed(),
            // 'passport_data'                         => $message->getPassportData(),
            // 'proximity_alert_triggered'             => $message->getProximityAlertTriggered(),
            // 'forum_topic_created'                   => $message->getForumTopicCreated(),
            // 'forum_topic_edited'                    => $message->getForumTopicEdited(),
            // 'forum_topic_closed'                    => $message->getForumTopicClosed(),
            // 'forum_topic_reopened'                  => $message->getForumTopicReopened(),
            // 'general_forum_topic_hidden'            => $message->getGeneralForumTopicHidden(),
            // 'general_forum_topic_unhidden'          => $message->getGeneralForumTopicUnidden(),
            // 'video_chat_scheduled'                  => $message->getVideoChatScheduled(),
            // 'video_chat_started'                    => $message->getVideoChatStarted(),
            // 'video_chat_ended'                      => $message->getVideoChatEnded(),
            // 'video_chat_participants_invited'       => $message->getVideoChatParticipantsInvited(),
            // 'web_app_data'                          => $message->getWebAppData(),
            'reply_markup'                          => $message->getReplyMarkup() ? json_encode($message->getReplyMarkup()) : NULL,



        ]);
        return $message->id;
    }

    static private function insertCallbackQueryRequest(?CallbackQuery $callback_query): ?int
    {
        if ($callback_query === null) {
            return null;
        }

        $callback_query = TelegramCallbackQuery::create([
            'callback_query_id'     => $callback_query->getId(),
            'from'                  => self::insertUserRequest($callback_query->getFrom()),
            'message'               => self::insertMessageRequest($callback_query->getMessage()),
            'inline_message_id'     => $callback_query->getInlineMessageId(),
            'chat_instance'         => $callback_query->getChatInstance(),
            'data'                  => $callback_query->getData()->getButton(),
            'game_short_name'       => $callback_query->getGameShortName(),
        ]);

        return $callback_query->id;
    }

    /**
     * Inserts a new user into the database, or updates an existing user.
     * 
     * @param array $data The user data to insert or update.
     * 
     * @return int
     */

     static public function insertUserRequest(?User $user): ?int
     {
        if ($user === null) {
            return null;
        }

        $user = self::getBot()->users()->updateOrCreate([
            'user_id'   => $user->getId(),
            'telegram_bot_id'    => self::getBot()->id,
        ],[
            'is_bot'                        => $user->getIsBot(),
            'first_name'                    => $user->getFirstName(),
            'last_name'                     => $user->getLastName(),
            'username'                      => $user->getUsername(),
            'language_code'                 => $user->getLanguageCode(),
            'is_premium'                    => $user->getIsPremium(),
            'added_to_attachment_menu'      => $user->getAddedToAttachmentMenu(),
            'can_join_groups'               => $user->getCanJoinGroups(),
            'can_read_all_group_messages'   => $user->getCanReadAllGroupMessages(),
            'supports_inline_queries'       => $user->getSupportsInlineQueries(),
        ]);

        return $user->id;
     }

     /**
     * Inserts a new chat into the database, or updates an existing chat.
     * 
     * @param Chat $data The chat data to insert or update.
     * 
     * @return int
     */

     static public function insertChatRequest(?Chat $chat): ?int
     {
        if ($chat === null) {
            return null;
        }
        
        $chat = self::getBot()->chats()->updateOrCreate([
            'chat_id'   => $chat->getId(),
            'telegram_bot_id'    => self::getBot()->id,
        ],[
            'type'                                      => $chat->getType(),
            'title'                                     => $chat->getTitle(),
            'username'                                  => $chat->getUsername(),
            'first_name'                                => $chat->getFirstName(),
            'last_name'                                 => $chat->getLastName(),
            'is_forum'                                  => $chat->getIsForum(),
            'photo'                                     => $chat->getPhoto()?->getSmallFileId(),
            'active_usernames'                          => $chat->getActiveUsernames() ? json_encode($chat->getActiveUsernames()) : NULL,
            'emoji_status_custom_emoji_id'              => $chat->getEmojiStatusCustomEmojiId(),
            'bio'                                       => $chat->getBio(),
            'has_private_forwards'                      => $chat->getHasPrivateForwards(),
            'has_restricted_voice_and_video_messages'   => $chat->getHasRestrictedVoiceAndVideoMessages(),
            'join_to_send_messages'                     => $chat->getJoinToSendMessages(),
            'join_by_request'                           => $chat->getJoinByRequest(),
            'description'                               => $chat->getDescription(),
            'invite_link'                               => $chat->getInviteLink(),
            'pinned_message'                            => self::selectMessage($chat->getPinnedMessage())?->id,
            'permissions'                               => json_encode($chat->getPermissions()) ?? null,
            'slow_mode_delay'                           => $chat->getSlowModeDelay(),
            'message_auto_delete_time'                  => $chat->getMessageAutoDeleteTime(),
            'has_aggressive_anti_spam_enabled'          => $chat->getHasAggressiveAntiSpamEnabled(),
            'has_hidden_members'                        => $chat->getHasHiddenMembers(),
            'has_protected_content'                     => $chat->getHasProtectedContent(),
            'sticker_set_name'                          => $chat->getStickerSetName(),
            'can_set_sticker_set'                       => $chat->getCanSetStickerSet(),
            'linked_chat_id'                            => $chat->getLinkedChatId(),
            'location'                                  => $chat->getLocation() ? json_encode($chat->getLocation()) : NULL,
        ]);

        return $chat->id;
     }

     static private function insertChatMemberUpdatedRequest(?ChatMemberUpdated $chat_member_updated)
     {
        if ($chat_member_updated === null) {
            return null;
        }

        $chat_member_updated = TelegramChatMemberUpdate::create([
            'chat'              => self::insertChatRequest($chat_member_updated->getChat()),
            'from'              => self::insertUserRequest($chat_member_updated->getFrom()),
            'date'              => $chat_member_updated->getDate(),
            'old_chat_member'   => $chat_member_updated->getOldChatMember() ? json_encode($chat_member_updated->getOldChatMember()) : NULL,
            'new_chat_member'   => $chat_member_updated->getNewChatMember() ? json_encode($chat_member_updated->getNewChatMember()) : NULL,
            'invite_link'       => $chat_member_updated->getInviteLink() ? json_encode($chat_member_updated->getInviteLink()) : NULL,
        ]);

        return $chat_member_updated->id;
     }

     static private function insertChatJoinRequest(?ChatJoinRequest $chat_join_request)
     {
        if ($chat_join_request === null) {
            return null;
        }

        $chat_join_request = TelegramChatJoinRequest::create([
            'chat'              => self::insertChatRequest($chat_join_request->getChat()),
            'from'              => self::insertUserRequest($chat_join_request->getFrom()),
            'user_chat_id'      => $chat_join_request->getUserChatId(),
            'date'              => $chat_join_request->getDate(),
            'bio'               => $chat_join_request->getBio(),
            'invite_link'       => $chat_join_request->getInviteLink() ? json_encode($chat_join_request->getInviteLink()) : NULL,
        ]);

        return $chat_join_request->id;
     }

     static private function selectMessage(?Message $message)
     {
        if ($message === null) {
            return null;
        }

        $message = TelegramMessage::where([
            'message_id'                => $message->getMessageId(),
            'chat'                      => self::getChat($message->getChat()->getId())->id,
            'message_thread_id'         => $message->getMessageThreadId(),
        ])->first();

        return $message;
     }

    /**
     * Retrieves the expectation for the specified user.
     * 
     * @param int|null $user_id The ID of the user to retrieve the expectation for.
     * 
     * @return string|null The user's expectation, or null if it doesn't exist.
     */

    static public function getExpectation(?int $user_id = null): ?string
    {
        $expectation = self::getUser($user_id)->expectation;
        
        self::setExpectation($user_id);
        return $expectation;
    }

    /**
     * Sets the expectation for the specified user.
     * 
     * @param int|null $user_id      The ID of the user to set the expectation for.
     * @param mixed    $expectation The expectation value to set.
     * 
     * @return void
     */

    static public function setExpectation(?int $user_id = null, $expectation = null): void
    {
        self::getUser($user_id)->update([
            'expectation' => $expectation
        ]);
    }

    static public function setReferal(?int $chat_id = null, $referal_id = null): void
    {
        self::getChat($chat_id)->update([
            'referal_id' => $referal_id
        ]);
    }

    static public function getReferal(?int $chat_id = null): ?string
    {
        return self::getChat($chat_id)->referal_id;
    }

    static public function setManager(?int $chat_id = null, $manager_id = null): void
    {
        self::getChat($chat_id)->update([
            'manager_id' => $manager_id
        ]);
    }

    static public function getManager(?int $chat_id = null): ?string
    {
        return self::getChat($chat_id)->manager_id;
    }

    /**
     * Inserts the last message ID for the specified user.
     * 
     * @param int|null $message_id The ID of the last message sent to the user.
     * @param int|null $user_id    The ID of the user to insert the last message ID for.
     * 
     * @return void
     */

    static public function setLastMessageId(?int $chat_id = null, ?int $message_id = null): void
    {
        self::getChat($chat_id)->update([
            'last_response_message_id' => $message_id
        ]);
    }

    /**
     * Retrieves the last message ID for the specified user.
     * 
     * @param int|null $user_id The ID of the user to retrieve the last message ID for.
     * 
     * @return int|null The last message ID for the user, or null if it doesn't exist.
     */

    static public function getLastMessageId(?int $chat_id = null): ?int
    {
        return TelegramMessage::where([
                'chat' => self::getChat($chat_id)->id,
                'from'  => self::getUser(self::getBot()->id)->id
            ])
            ->get()
            ?->last()
            ?->message_id;
    }

    /**
     * Retrieves the role for the specified user.
     * 
     * @param int|null $user_id The ID of the user to retrieve the role for.
     * 
     * @return string|null The user's role, or null if it doesn't exist.
     */

    static public function getRole(?int $chat_id = null): ?string
    {
        return self::getChat($chat_id)->role;
    }

    /**
     * Set the role of the specified user.
     *
     * @param int|null $user_id The ID of the user. If not specified, it defaults to the current user.
     * @param string|null $role The role to set for the user.
     * @throws TelegramException If the user is not found.
     */

    static public function setRole(?int $chat_id = null, ?string $role): void
    {
        self::getChat($chat_id)->update([
            'role' => $role
        ]);
    }

    static public function getAdmins()
    {
        $admins = self::getBot()->chats()->where('role', 'admin')->pluck('chat_id');
        
        return $admins;
    }

    /**
     * Get the bot associated with the current Telegram instance.
     *
     * @return TelegramBot The bot associated with the current Telegram instance.
     * @throws TelegramException If the bot is not found.
     */
    
    static public function getBot(): ?TelegramBot
    {
        if (is_null(static::$telegram_bot)) {
            static::$telegram_bot = TelegramBot::where('id', self::$bot->getBotId())->first();
        }
        
        return static::$telegram_bot;
    }

    /**
     * Get the specified user from the bot's users table.
     *
     * @param int|null $user_id The ID of the user. If not specified, it defaults to the current user.
     * @return TelegramUser The specified user.
     * @throws TelegramException If the user is not found.
     */

    static protected function getUser(?int $user_id = null): TelegramUser
    {
        $user = self::getBot()->users()->where('user_id', $user_id)->first();
        
        if (!$user) {
            throw new TelegramException("User: {$user_id} not found");
        }

        return $user;
    }

    static public function getChat(?int $chat_id = null): TelegramChat
    {
        $chat = self::getBot()->chats()->where('chat_id', $chat_id)->first();

        if (!$chat) {
            throw new TelegramException("Chat: {$chat_id} not found");
        }

        return $chat;
    }
}