<?php

namespace Romanlazko\Telegram\Exceptions;

class TelegramUserException extends \Exception
{
    protected $message; 
    protected $params;
    protected $code; 

    public function __construct(string $message = "", int $code = 0, array $params = [])
    {
        parent::__construct($message, $code);
    }
    
}