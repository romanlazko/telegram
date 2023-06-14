<?php

namespace Romanlazko\Telegram\Exceptions;

use Romanlazko\Telegram\App\Entities\Response;

/**
 * TelegramException class extends the base PHP Exception class and adds functionality for handling Telegram API exceptions.
 *
 * @package App\Telegram\Exceptions
 */

class TelegramException extends \Exception
{
    protected $response; 

    protected $params;

    /**
     * TelegramException constructor.
     *
     * @param string $response The response string.
     * @param int $code The exception code.
     * @param array $params The array of parameters.
     */

    public function __construct(string $response = "", int $code = 0, array $params = [])
    {
        $this->response = Response::fromRequest(
            json_decode($response, true) ?? ['ok' => false, 'description' => $response]
        );

        $this->params = $params;

        parent::__construct($this->response->getDescription(), $code);
    }

    /**
     * Returns the value of the 'ok' property from the response object.
     *
     * @return bool The value of the 'ok' property.
     */

    public function getOk(): bool
    {
        return $this->response->getOk();
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