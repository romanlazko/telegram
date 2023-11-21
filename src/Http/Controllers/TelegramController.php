<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Romanlazko\Telegram\App\Config;
use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Generators\BotDirectoryGenerator;
use Romanlazko\Telegram\Http\Requests\BotStoreRequest;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Providers\TelegramServiceProvider;

class TelegramController extends Controller
{
    public function index($telegramOwner)
    {
        $telegram_bots = auth()->user()->telegram_bots;

        if ($telegram_bots->isEmpty()) {
            return redirect()->route('admin.telegram_bot.create');
        }

        $telegram_bots->map(function ($telegram_bot) {
            $bot = new Bot($telegram_bot->token);
            $telegram_bot->photo = $bot->getBotChat()->getPhotoLink();
            return $telegram_bot;
        });

        return view('admin.telegram.index', compact([
            'telegram_bots'
        ]));
    }

    public function create()
    {
        return view('admin.telegram.create');
    }

    public function store(BotStoreRequest $request)
    {
        try {
            $bot = new Bot($request->token);

            $response = $bot::setWebHook([
                'url' => $request->url."/{$bot->getBotId()}",
            ]);

            if ($response->getOk()) {
                $telegram_bot = auth()->user()->telegram_bots()->create([
                    'id'            => $bot->getBotChat()->getId(),
                    'first_name'    => $bot->getBotChat()->getFirstName(),
                    'last_name'     => $bot->getBotChat()->getLastName(),
                    'username'      => $bot->getBotChat()->getUsername(),
                    'photo'         => $bot->getBotChat()->getPhoto()?->getBigFileId(),
                    'token'         => $request->token,
                    'namespace'     => 'buukan_bot',
                ]);
            }
            
            return redirect()->route('admin.telegram_bot.show', $telegram_bot)->with([
                'ok' => $response->getOk(), 
                'description' => $response->getDescription()
            ]);
        }
        catch (TelegramException $e){
            return back()->with([
                'ok' => false, 
                'description' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $telegram_bot->photo                  = $bot->getBotChat()->getPhotoLink();
        $telegram_bot->webhook                = $bot::getWebhookInfo()->getResult();
        $telegram_bot->all_commands_list      = $bot->getAllCommandsList();
        $telegram_bot->config                 = Config::$config;
        $telegram_bot->logs                   = $telegram_bot->logs();

        return view('admin.telegram.show', compact([
            'telegram_bot'
        ]));
    }

    public function edit(TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $telegram_bot->photo                  = $bot->getBotChat()->getPhotoLink();
        $telegram_bot->webhook                = $bot::getWebhookInfo()->getResult();
        $telegram_bot->all_commands_list      = $bot->getAllCommandsList();
        $telegram_bot->config                 = Config::$config;
        $telegram_bot->logs                   = $telegram_bot->logs();

        return view('admin.telegram.edit', compact([
            'telegram_bot'
        ]));
    }

    public function update(Request $request, TelegramBot $telegram_bot)
    {
        auth()->user()->telegram_bots()->find($telegram_bot->id)->update([
            'settings' => $request->settings
        ]);
        return back();
    }
    
    public function destroy(TelegramBot $telegram_bot)
    {
        $company->telegram_bot->delete();

        return back();
    }
}
