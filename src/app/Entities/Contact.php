<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Contact
 *
 * @link https://core.telegram.org/bots/api#contact
 *
 * @method string getPhoneNumber() Contact's phone number
 * @method string getFirstName()   Contact's first name
 * @method string getLastName()    Optional. Contact's last name
 * @method int    getUserId()      Optional. Contact's user identifier in Telegram
 * @method string getVcard()       Optional. Additional data about the contact in the form of a vCard
 */
class Contact extends BaseEntity
{
    public static $map = [
        'phone_number'      => true,
        'first_name'        => true,
        'last_name'	        => true,
        'user_id'	        => true,
        'vcard'	            => true,
    ];
}