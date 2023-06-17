<?php

namespace Romanlazko\Telegram\Exceptions;

/**
 * TelegramException class extends the base PHP Exception class and adds functionality for handling Telegram API exceptions.
 *
 * @package Rpmanlazko\Telegram\Exceptions
 */

class TelegramException extends \Exception
{
    private $params;

    /**
     * TelegramException constructor.
     *
     * @param string  $message The exception message.
     * @param int $code The exception code.
     * @param array $params The array of parameters.
     */

    public function __construct(string $message = '', int $code = 0, array $params = [])
    {
        $this->params = $params;

        parent::__construct($message, $code);
    }

    /**
     * Returns the parameters array for this class.
     *
     * @return array The parameters array for this class.
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Returns the parameters array for the class as a JSON string.
     *
     * @return string The JSON-encoded string representation of the params array.
     */
    public function getParamsAsJson(): string
    {
        return json_encode($this->params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}