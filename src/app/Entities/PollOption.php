<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class PollOption
 *
 * This entity contains information about one answer option in a poll.
 *
 * @link https://core.telegram.org/bots/api#polloption
 *
 * @method string getText()       Option text, 1-100 characters
 * @method int    getVoterCount() Number of users that voted for this option
 */
class PollOption extends BaseEntity
{
    public static $map = [
        'text'          => true,
        'voter_count'   => true,
    ];
}