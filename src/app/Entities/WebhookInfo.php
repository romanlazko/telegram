<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;

class WebhookInfo extends BaseEntity
{
    public static $map = [
        'url'                               => true,
        'has_custom_certificate'            => true,
        'pending_update_count'              => true,
        'ip_address'                        => true,
        'last_error_date'                   => true,
        'last_error_message'                => true,
        'last_synchronization_error_date'   => true,
        'allowed_updates'                   => [true],
    ];
}