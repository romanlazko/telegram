<?php

namespace Romanlazko\Telegram\App;

use Romanlazko\Telegram\Exceptions\TelegramException;

class TelegramLogDb extends DB
{
    public static function report(TelegramException|\Exception|\Throwable|\Error $exception)
    {
        if (self::shouldReport($exception)) {
            self::logToDatabase($exception);
        }
    }

    protected static function shouldReport(TelegramException|\Exception|\Throwable|\Error $exception)
    {
        if ($exception instanceof TelegramException) {
            return true;
        }

        if ($exception instanceof \Exception) {
            return true;
        }

        if ($exception instanceof \Throwable) {
            return true;
        }

        if ($exception instanceof \Error) {
            return true;
        }

        return false;
    }

    protected static function logToDatabase(TelegramException|\Exception|\Throwable|\Error $exception)
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