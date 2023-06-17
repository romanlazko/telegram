<?php

namespace Romanlazko\Telegram\App;

use JsonException;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Exceptions\TelegramUserException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class TelegramLogDb extends DB
{
    public static function report(\Exception|TelegramException $exception)
    {
        if (self::shouldReport($exception)) {
            self::logToDatabase($exception);
        }
    }

    protected static function shouldReport(\Exception|TelegramException $exception)
    {
        if ($exception instanceof TelegramException) {
            return true;
        }

        if ($exception instanceof TelegramUserException) {
            return true;
        }

        if ($exception instanceof JsonException) {
            return true;
        }

        return false;
    }

    static public function logToDatabase(\Exception|TelegramException $exception)
    {
        self::getBot()->logs()->create([
            'message'       => $exception->getMessage(),
            'code'          => $exception->getCode(),
            'params'        => method_exists($exception, 'getParamsAsJson') ? $exception->getParamsAsJson() : null,
            'file'          => $exception->getFile(),
            'line'          => $exception->getLine(),
            'trace'         => $exception->getTraceAsString(),
        ]);
    }
}