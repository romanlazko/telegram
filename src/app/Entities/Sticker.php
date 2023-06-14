<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Sticker
 *
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @method string       getFileId()           Identifier for this file, which can be used to download or reuse the file
 * @method string       getFileUniqueId()     Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @method string       getType()             Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
 * @method int          getWidth()            Sticker width
 * @method int          getHeight()           Sticker height
 * @method bool         getIsAnimated()       True, if the sticker is animated
 * @method bool         getIsVideo()          True, if the sticker is a video sticker
 * @method PhotoSize    getThumb()            Optional. Sticker thumbnail in .webp or .jpg format
 * @method string       getEmoji()            Optional. Emoji associated with the sticker
 * @method string       getSetName()          Optional. Name of the sticker set to which the sticker belongs
 * @method File         getPremiumAnimation() Optional. Premium animation for the sticker, if the sticker is premium
 * @method MaskPosition getMaskPosition()     Optional. For mask stickers, the position where the mask should be placed
 * @method string       getCustomEmojiId()    Optional. For custom emoji stickers, unique identifier of the custom emoji
 * @method int          getFileSize()         Optional. File size
 */
class Sticker extends BaseEntity
{
    public static $map = [
        'file_id'           => true,
        'file_unique_id'    => true,
        'type'              => true,
        'width'             => true,
        'height'	        => true,
        'is_animated'       => true,
        'is_video'          => true,
        'thumb'	            => PhotoSize::class,
        'emoji'             => true,
        'set_name'          => true,
        'premium_animation' => File::class,
        'mask_position'     => MaskPosition::class,
        'custom_emoji_id'   => true,
        'file_size'         => true,
    ];
}