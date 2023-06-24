<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Romanlazko\Telegram\App\Config;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Generators\BotDirectoryGenerator;
use Romanlazko\Telegram\Http\Requests\BotStoreRequest;
use Romanlazko\Telegram\Models\Bot;
use Romanlazko\Telegram\Providers\TelegramServiceProvider;

class BotController extends Controller
{
    public function switch(Bot $bot)
    {
        session()->put('current_bot', $bot->id);

        return redirect(TelegramServiceProvider::BOT);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(?Telegram $telegram)
    {
        if (!$telegram) {
            return redirect()->route('bot.create');
        }

        $bot = (object)[
            'id'                => $telegram->getBotChat()->getId(),
            'first_name'        => $telegram->getBotChat()->getFirstName(),
            'username'          => $telegram->getBotChat()->getUsername(),
            'photo'             => $telegram->getBotChat()->getPhotoLink(),
            'webhook'           => $telegram::getWebhookInfo()->getResult(),
            'all_commands_list' => $telegram->getAllCommandsList(),
            'config'            => Config::$config,
            'logs'              => request()->user()->current()->logs(),
        ];

        return view('telegram::bot.index', compact('bot'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    public function create()
    {
        return view('telegram::bot.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(BotStoreRequest $request)
    {
        try {
            $telegram = new Telegram($request->token);

            $response = $telegram::setWebHook([
                'url' => "{$request->url}/{$telegram->getBotId()}",
            ]);

            if ($response->getOk()) {

                $user = $request->user();

                $user->update([
                    'chat_id' => $request->chat_id
                ]);
            
                $bot = $user->bots()->withTrashed()->updateOrCreate([
                    'id'            => $telegram->getBotChat()->getId(),
                ],[
                    'id'            => $telegram->getBotChat()->getId(),
                    'user_id'       => $user->id,
                    'first_name'    => $telegram->getBotChat()->getFirstName(),
                    'last_name'     => $telegram->getBotChat()->getLastName(),
                    'username'      => $telegram->getBotChat()->getUsername(),
                    'photo'         => $telegram->getBotChat()->getPhoto()?->getBigFileId(),
                    'token'         => $request->token,
                    'deleted_at'    => null
                ]);

                BotDirectoryGenerator::createBotDirectories($bot->username);

                session()->put('current_bot', $bot->id);
            }
            
            return redirect()->route('bot.index')->with([
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

    // /**
    //  * Display the specified resource.
    //  */
    public function show(?Telegram $telegram)
    {
        try {
            $response = $telegram::sendMessage([
                'text' => "It is Work",
                'chat_id' => request()->user()->chat_id
            ]);
            return back()->with([
                'ok' => $response->getOk(), 
                'description' => "Success"
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
     * Remove the specified resource from storage.
     */
    public function destroy(Bot $bot)
    {
        $bot->delete();

        return back();
    }
}
