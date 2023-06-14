<?php 

namespace Romanlazko\Telegram\App\Commands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Conversation;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Exceptions\TelegramUserException;

abstract class Command 
{
    public static $command = '';

    public static $expectation = '';

    public static $title = '';

    public static $usage = [];

    public static $pattern = '';

    protected $enabled = false;

    protected $bot;
    
    protected $updates;

    protected $conversation = null;

    public function __construct(Telegram $bot, Update $updates)
    {
        $this->bot      = $bot;
        $this->updates  = $updates;
    }

    public function preExecute()
    {
        try{
            return $this->execute($this->updates);
        }
        catch( TelegramUserException $exception ){
            return $this->handleError($exception->getMessage());
        }
    }

    abstract public function execute(Update $updates);

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function handleError(string $text): ?Response
    {
        return BotApi::sendMessage([
            'text'          => $text,
            'chat_id'       => $this->updates->getChat()->getId(),
            'parse_mode'    => "Markdown"
        ]);
    }

    public function handleMainAdminError(TelegramException $exception): ?Response
    {
        $text = [];

        $text[] = "Description: ".$exception->getMessage();
        $text[] = "Code: ".$exception->getCode();
        $text[] = "Params: ".$exception->getParamsAsJson();
        $text[] = "File: ".$exception->getFile()." -> ".$exception->getLine();

        return BotApi::sendMessage([
            'text'          => implode("\n\n", $text),
            'chat_id'       => $this->bot->getMainAdmin(),
        ]);
    }

    protected function getConversation(int $user_id = null)
    {
        if ($this->conversation === null) {
            $user_id = $this->updates->getFrom()->getId($user_id);
            $this->conversation = new Conversation($user_id);
        }
        return $this->conversation;
    }

    protected function getUserContact(string $parse_mode = 'Markdown', int $chat_id = null): string
    {
        if ($chat_id === null) {
            $chat = $this->updates->getChat();
        }else{
            $chat = BotApi::getChat([
                'chat_id' => $chat_id
            ])->getResult();
        }

        if ($chat->getUsername()) {
            return "@{$chat->getUsername()}";
        } else {
            if ($parse_mode === 'HTML') {
                return "<a href='tg://user?id={$chat->getId()}'>{$chat->getFirstName()} {$chat->getLastName()}</a>";
            }
            return "[tg://user?id={$chat->getId()}]({$chat->getFirstName()} {$chat->getLastName()})";
        }
    }

    public static function getTitle(string $lang = 'en'): string
    {
        if(property_exists(self::class, 'title') AND is_array(static::$title)){
            return static::$title[$lang] ?? static::$title['en'];   
        }
        return static::$title ?? '';
    }

    





}
