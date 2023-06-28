<?php

namespace Romanlazko\Telegram\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Romanlazko\Telegram\Providers\TelegramServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class Telegram
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next, string $bot_username): Response
    {
        if (is_null($request->user()->bot)) {
            return redirect(TelegramServiceProvider::BOT);
        }

        if ($request->user()->bot->username === $bot_username OR $bot_username === 'default') {
            return $next($request);
        }

        return redirect(TelegramServiceProvider::BOT);
    }
}
