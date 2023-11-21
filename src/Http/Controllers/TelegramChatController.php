<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\TelegramChat;

class TelegramChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $telegram_bot->photo = $bot::getPhoto(['file_id' => $telegram_bot->photo]);

        $chats = $telegram_bot->chats()->search($request->search)
            ->orderByDesc('updated_at')
            ->paginate(20);

        $chats_collection = $chats->map(function ($chat) use ($bot){
            $last_message           = $chat->messages()->latest()->limit(1)->first();
            $chat->last_message     = Str::limit($last_message?->text ?? $last_message?->caption, 60);
            $chat->photo            = $bot::getPhoto(['file_id' => $chat->photo]);
            return $chat;
        });

        return view('admin.telegram.chat.index', compact([
            'telegram_bot',
            'chats',
            'chats_collection'
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(TelegramBot $telegram_bot, TelegramChat $chat)
    {
        $bot = new Bot($telegram_bot->token);

        $chat->photo = $bot::getPhoto(['file_id' => $chat->photo]);

        $messages = $chat->messages()
            ->orderBy('id', 'DESC')
            ->with(['user', 'callback_query', 'callback_query.user'])
            ->paginate(20);

        $messages->map(function ($message) use ($bot){
            if ($message->photo) {
                $message->photo = $bot::getPhoto(['file_id' => $message->photo]);
            }
        });

        return view('admin.telegram.chat.show', compact(
            'chat',
            'telegram_bot',
            'messages'
        ));
    }

    public function edit(TelegramBot $telegram_bot, TelegramChat $chat) 
    {
        $bot = new Bot($telegram_bot->token);

        $chat->photo = $bot::getPhoto(['file_id' => $chat->photo]);

        return view('admin.telegram.chat.edit', compact(
            'chat',
            'telegram_bot'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TelegramBot $telegram_bot, TelegramChat $chat)
    {
        try {
            auth()->user()->telegram_bots()->find($telegram_bot->id)
                ->chats()->find($chat->id)
                ->update([
                    'role' => $request->role,
                    'settings' => $request->settings
                ]);

            return back()->with([
                'ok' => true, 
                'description' => "Updated"
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'ok' => false, 
                'description' => $e->getMessage()
            ]);
        }
    }
}
