<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Models\TelegramChat;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TelegramChat $chat, Telegram $telegram, Request $request)
    {
        $chat->photo = $telegram::getPhoto(['file_id' => $chat->photo]);
        
        $messages = $chat->messages()
            ->search($request->search)
            ->orderBy('id', 'DESC')
            ->with(['user', 'callback_query', 'callback_query.user'])
            ->paginate(20);

        $messages->map(function ($message) use ($telegram){
            if ($message->photo) {
                $message->photo = $telegram::getPhoto(['file_id' => $message->photo]);
            }
        });

        return view('telegram::chat.message.index', compact('messages', 'chat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TelegramChat $chat, Telegram $telegram)
    {
        try {
            if ($request->has('command')) {
                $buttons = $telegram::inlineKeyboard([
                    [array($request->command::getTitle('ru'), $request->command::$command, '')]
                ]);
            }

            $response = $telegram::sendMessage([
                'text'          => $request->message,
                'chat_id'       => $chat->chat_id,
                'reply_markup'  => $buttons ?? null
            ]);
            
            return back()->with([
                'ok' => $response->getOk(), 
                'description' => "Message successfully sent"
            ]);
        }
        catch (TelegramException $e){
            return back()->with([
                'ok' => false, 
                'description' => $e->getMessage()
            ]);
        }
    }
}
