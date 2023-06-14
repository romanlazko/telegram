<?php

namespace Romanlazko\Telegram\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Telegram
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next, string $bot_username): Response
    {
        if (is_null(auth()->user()->bot)) {
            return redirect(RouteServiceProvider::HOME);
        }

        if (auth()->user()->bot->username === $bot_username OR $bot_username === 'default') {
            return $next($request);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
