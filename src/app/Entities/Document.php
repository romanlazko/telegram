<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Document
 *
 * @link https://core.telegram.org/bots/api#document
 *
 * @method string    getFileId()       Identifier for this file, which can be used to download or reuse the file
 * @method string    getFileUniqueId() Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @method PhotoSize getThumb()        Optional. Document thumbnail as defined by sender
 * @method string    getFileName()     Optional. Original filename as defined by sender
 * @method string    getMimeType()     Optional. MIME type of the file as defined by sender
 * @method int       getFileSize()     Optional. File size
 */
class Document extends BaseEntity
{
    public static $map = [
        'file_id'         => true,
        'file_unique_id'  => true,
        'file_name'	      => true,
        'mime_type'	      => true,
        'file_size'       => true,
        'thumb'	          => PhotoSize::class,
    ];
}