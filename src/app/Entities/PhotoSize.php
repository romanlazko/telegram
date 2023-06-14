<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class PhotoSize
 *
 * @link https://core.telegram.org/bots/api#photosize
 *
 * @method string getFileId()       Identifier for this file, which can be used to download or reuse the file
 * @method string getFileUniqueId() Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @method int    getWidth()        Photo width
 * @method int    getHeight()       Photo height
 * @method int    getFileSize()     Optional. File size
 */

 
class PhotoSize extends BaseEntity
{
    public static $map = [
        'file_id'         => true,
        'file_unique_id'  => true,
        'width'           => true,
        'height'	      => true,
        'file_size'       => true,
    ];
}