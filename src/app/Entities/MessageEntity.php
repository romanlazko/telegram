<?php

namespace Romanlazko\Telegram\App\Entities;

/**
 * Class MessageEntity
 *
 * @link https://core.telegram.org/bots/api#messageentity
 *
 * @method string getType()          Type of the entity. Currently, can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers)
 * @method int    getOffset()        Offset in UTF-16 code units to the start of the entity
 * @method int    getLength()        Length of the entity in UTF-16 code units
 * @method string getUrl()           Optional. For "text_link" only, url that will be opened after user taps on the text
 * @method User   getUser()          Optional. For "text_mention" only, the mentioned user
 * @method string getLanguage()      Optional. For "pre" only, the programming language of the entity text
 * @method string getCustomEmojiId() Optional. For “custom_emoji” only, unique identifier of the custom emoji. Use getCustomEmojiStickers to get full information about the sticker
 */
class MessageEntity extends BaseEntity
{
    public static $map = [
        'type'  => true,
        'offset' => true,
        'length' => true,
        'url' => true,
        'user' => User::class,
        'language' => true,
        'custom_emoji_id' => true,
    ];
}