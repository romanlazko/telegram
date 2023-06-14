<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Video
 *
 * @link https://core.telegram.org/bots/api#video
 *
 * @method string    getFileId()       Identifier for this file, which can be used to download or reuse the file
 * @method string    getFileUniqueId() Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @method int       getWidth()        Video width as defined by sender
 * @method int       getHeight()       Video height as defined by sender
 * @method int       getDuration()     Duration of the video in seconds as defined by sender
 * @method PhotoSize getThumb()        Optional. Video thumbnail
 * @method string    getFileName()     Optional. Original filename as defined by sender
 * @method string    getMimeType()     Optional. Mime type of a file as defined by sender
 * @method int       getFileSize()     Optional. File size
 */
class Video extends BaseEntity
{
    public static $map = [
        'file_id'         => true,
        'file_unique_id'  => true,
        'width'           => true,
        'height'	      => true,
        'duration'	      => true,
        'thumb'	          => PhotoSize::class,
        'file_name'	      => true,
        'mime_type'	      => true,
        'file_size'       => true,
    ];
}