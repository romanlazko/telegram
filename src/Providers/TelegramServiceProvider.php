<?php

namespace Romanlazko\Telegram\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Models\Bot;

class TelegramServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const BOT = '/bot';

    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind(Telegram::class, function () {
        //     $bot = request()->user()->bot;

        //     if (is_null($bot)) {
        //         return null;
        //     }

        //     return new Telegram($bot->token);
        // });
        $this->app->bind(Telegram::class, function () {
            $bot = Bot::find(session()->get('current_bot', request()->bot));

            if (is_null($bot)) {
                return null;
            }

            return new Telegram($bot->token);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'telegram');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        Blade::componentNamespace('Romanlazko\\Telegram\\Views\\Components', 'telegram');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/telegram'),
        ]);
    }
}
