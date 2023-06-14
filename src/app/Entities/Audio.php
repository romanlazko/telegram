<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Audio
 *
 * @link https://core.telegram.org/bots/api#audio
 *
 * @method string    getFileId()       Identifier for this file, which can be used to download or reuse the file
 * @method string    getFileUniqueId() Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @method int       getDuration()     Duration of the audio in seconds as defined by sender
 * @method string    getPerformer()    Optional. Performer of the audio as defined by sender or by audio tags
 * @method string    getTitle()        Optional. Title of the audio as defined by sender or by audio tags
 * @method string    getFileName()     Optional. Original filename as defined by sender
 * @method string    getMimeType()     Optional. MIME type of the file as defined by sender
 * @method int       getFileSize()     Optional. File size
 * @method PhotoSize getThumb()        Optional. Thumbnail of the album cover to which the music file belongs
 */
class Audio extends BaseEntity
{
    public static $map = [
        'file_id'         => true,
        'file_unique_id'  => true,
        'duration'	      => true,
        'performer'	      => true,
        'title'	          => true,
        'file_name'	      => true,
        'mime_type'	      => true,
        'file_size'       => true,
        'thumb'	          => PhotoSize::class,
    ];
}