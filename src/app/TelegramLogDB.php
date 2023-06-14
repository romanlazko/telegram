<?php

namespace Romanlazko\Telegram\App;

use Romanlazko\Telegram\Exceptions\TelegramException;
use Throwable;

class TelegramLogDb extends DB
{
    static public function insertLog(TelegramException|Throwable $exception)
    {
        self::getBot()->logs()->create([
            'description'   => $exception->getMessage(),
            'code'          => $exception->getCode(),
            'params'        => method_exists($exception, 'getParamsAsJson') ? $exception->getParamsAsJson() : null,
            'file'          => $exception->getFile(),
            'line'          => $exception->getLine(),
            'trace'         => $exception->getTraceAsString(),
        ]);
    }
}