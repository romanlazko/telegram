<?php

namespace Romanlazko\Telegram\Exceptions;

class TelegramMainAdminException extends \Exception
{
    protected $message; 
    protected $params = [];
    protected $code; 

    public function __construct(string $message = "", int $code = 0, array $params = [])
    {
        $this->params = $params;
        parent::__construct($message, $code);
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParamsAsJson(): string
    {
        return json_encode($this->params);
    }
    
}