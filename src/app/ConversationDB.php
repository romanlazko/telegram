<?php

namespace Romanlazko\Telegram\App;

use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Models\TelegramConversation;
use Throwable;

class ConversationDB extends DB
{
    

    /**
     * Select a conversation from the DB
     *
     * @param int $user_id
     * @param int $chat_id
     * @param int $limit
     *
     * @return TelegramConversation|null
     * @throws TelegramException
     */
    public static function selectConversation(int $user_id): ?TelegramConversation
    {
        try {
            return self::getUser($user_id)->conversation;
        } 
        catch (Throwable $exception) {
            throw new TelegramException($exception->getMessage());
        }
    }

    /**
     * Insert the conversation in the database
     *
     * @param int    $user_id
     * @param int    $chat_id
     *
     * @return TelegramConversation
     * @throws TelegramException
     */
    public static function insertConversation(int $user_id): ?TelegramConversation
    {
        try {
            return self::getUser($user_id)->conversation()->create([
                'notes' => json_encode(['user_id' => $user_id])
            ]);
        } 
        catch (Throwable $exception) {
            throw new TelegramException($exception->getMessage());
        }
    }

    /**
     * Update a specific conversation
     *
     * @param array $fields_values
     * @param array $where_fields_values
     *
     * @return bool
     * @throws TelegramException
     */
    public static function updateConversation(array $fields_values, int $user_id): bool
    {
        try {
            return self::getUser($user_id)
                ->conversation()
                ->update($fields_values);
        } 
        catch (Throwable $exception) {
            throw new TelegramException($exception->getMessage());
        }
    }
}