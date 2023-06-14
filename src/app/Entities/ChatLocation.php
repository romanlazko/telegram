<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class ChatLocation
 *
 * Represents a location to which a chat is connected.
 *
 * @link https://core.telegram.org/bots/api#chatlocation
 *
 * @method Location getLocation() The location to which the supergroup is connected. Can't be a live location.
 * @method string   getAddress()  Location address; 1-64 characters, as defined by the chat owner
 */
class ChatLocation extends BaseEntity
{
    public static $map = [
        'location'      => Location::class,
        'address'       => true,
    ];
}