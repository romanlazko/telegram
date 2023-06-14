<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class File
 *
 * @link https://core.telegram.org/bots/api#file
 *
 * @method string getFileId()       Identifier for this file, which can be used to download or reuse the file
 * @method string getFileUniqueId() Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @method int    getFileSize()     Optional. File size, if known
 * @method string getFilePath()     Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
 */
class File extends BaseEntity
{
    public static $map = [
        'file_id'           => true,
        'file_unique_id'    => true,
        'file_size'         => true,
        'file_path'         => true,
    ];
}