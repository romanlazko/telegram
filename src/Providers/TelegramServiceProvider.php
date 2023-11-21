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

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views/telegram' => resource_path('views/admin/telegram'),
            __DIR__.'/../resources/views/components' => resource_path('views/components'),
        ], 'resources');

        $this->publishes([
            __DIR__.'/../database/migrations/stubs/create_telegram_bots_table.php.stub' => $this->getMigrationFileName('1_create_telegram_bots_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_users_table.php.stub' => $this->getMigrationFileName('2_create_telegram_users_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_chats_table.php.stub' => $this->getMigrationFileName('3_create_telegram_chats_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_messages_table.php.stub' => $this->getMigrationFileName('4_create_telegram_messages_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_callback_queries_table.php.stub' => $this->getMigrationFileName('5_create_telegram_callback_queries_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_chat_join_requests_table.php.stub' => $this->getMigrationFileName('6_create_telegram_chat_join_requests_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_chat_member_updates_table.php.stub' => $this->getMigrationFileName('7_create_telegram_chat_member_updates_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_conversations_table.php.stub' => $this->getMigrationFileName('8_create_telegram_conversations_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_logs_table.php.stub' => $this->getMigrationFileName('9_create_telegram_logs_table.php'),
            __DIR__.'/../database/migrations/stubs/create_telegram_updates_table.php.stub' => $this->getMigrationFileName('10_create_telegram_updates_table.php'),
            __DIR__.'/../database/migrations/stubs/create_advertisements_table.php.stub' => $this->getMigrationFileName('11_create_advertisements_table.php'),
            __DIR__.'/../database/migrations/stubs/create_advertisement_images_table.php.stub' => $this->getMigrationFileName('12_create_advertisement_images_table.php'),
        ], 'migrations');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
