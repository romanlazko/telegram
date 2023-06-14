<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Entities\BaseEntity;

/**
 * Class Response
 *
 * @link https://core.telegram.org/bots/api#making-requests
 *
 * @method bool   getOk()          If the request was successful
 * @method mixed  getResult()      The result of the query
 * @method int    getErrorCode()   Error code of the unsuccessful request
 * @method string getDescription() Human-readable description of the result / unsuccessful request
 *
 * @todo method ResponseParameters getParameters()  Field which can help to automatically handle the error
 */

class Response extends BaseEntity
{
    public static $map = [
        'ok'                                => true,
        'description'                       => true,
        'result'                            => Result::class,
        'results'                           => true,
        'error_code'                        => true
    ];
}