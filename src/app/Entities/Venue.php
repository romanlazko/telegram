<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Venue
 *
 * @link https://core.telegram.org/bots/api#venue
 *
 * @method Location getLocation()        Venue location
 * @method string   getTitle()           Name of the venue
 * @method string   getAddress()         Address of the venue
 * @method string   getFoursquareId()    Optional. Foursquare identifier of the venue
 * @method string   getFoursquareType()  Optional. Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
 * @method string   getGooglePlaceId()   Optional. Google Places identifier of the venue
 * @method string   getGooglePlaceType() Optional. Google Places type of the venue
 */
class Venue extends BaseEntity
{
    public static $map = [
        'location'          => Location::class,
        'title'             => true,
        'address'	        => true,
        'foursquare_id'     => true,
        'foursquare_type'   => true,
        'google_place_id'   => true,
        'google_place_type' => true,
    ];
}