<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Models\TelegramChat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Telegram $telegram)
    {
        $chats = TelegramChat::search($request->search)
            ->where('bot_id', $telegram->getBotId())
            ->orderByDesc('updated_at')
            ->paginate(20);

        $chats_collection = $chats->map(function ($chat) {
            $last_message           = $chat->messages()->latest()->limit(1)->first();
            $chat->last_message     = Str::limit($last_message?->text ?? $last_message?->caption, 60);
            return $chat;
        });

        return view('telegram::chat.index', compact([
            'chats',
            'chats_collection'
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(TelegramChat $chat)
    {
        return view('telegram::chat.show', compact(
            'chat',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TelegramChat $chat)
    {
        try {
            $chat->update($request->all());

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
