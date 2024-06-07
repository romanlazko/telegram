<?php

namespace Romanlazko\Telegram\Console\Commands;

use Illuminate\Console\Command;
use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Generators\BotDirectoryGenerator;
use Romanlazko\Telegram\Models\TelegramBot;

class CreateTelegramBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:telegram {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a telegram bot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bot = new Bot($this->argument('token'));

        $response = $bot::setWebHook([
            'url' => env('APP_URL').'/api/telegram/'.$bot->getBotId(),
        ]);

        if ($response->getOk()) {
            $telegram_bot = TelegramBot::updateOrCreate([
                'id'            => $bot->getBotChat()->getId(),
                'first_name'    => $bot->getBotChat()->getFirstName(),
                'last_name'     => $bot->getBotChat()->getLastName(),
                'username'      => $bot->getBotChat()->getUsername(),
                'photo'         => $bot->getBotChat()->getPhoto()?->getBigFileId(),
                'token'         => $this->argument('token'),
            ]);
        }

        if ($telegram_bot) {
            BotDirectoryGenerator::createBotDirectories($telegram_bot->username);
        }

        return $this->info($response->getDescription());
    }
}
