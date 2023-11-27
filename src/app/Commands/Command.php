<?php 

namespace Romanlazko\Telegram\App\Commands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Config;
use Romanlazko\Telegram\App\Conversation;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\App\Bot;
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

    protected $conversation = null;

    public function __construct(
        protected Bot $bot, 
        protected Update $updates
    ){
        app()->setLocale(Config::get('lang') ?? $updates->getFrom()->getLanguageCode());
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

    protected function getConversation(int $user_id = null)
    {
        if ($this->conversation === null) {
            $user_id = $this->updates->getFrom()->getId($user_id);
            $this->conversation = new Conversation($user_id);
        }
        return $this->conversation;
    }

    public static function getTitle(string $lang = null): string
    {
        if(property_exists(self::class, 'title') AND is_array(static::$title)){
            return static::$title[$lang ?? app()->getLocale()] ?? ucfirst(static::$command);   
        }
        return static::$title ?? ucfirst(static::$command);
    }
}
