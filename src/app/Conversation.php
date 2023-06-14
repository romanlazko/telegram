<?php

namespace Romanlazko\Telegram\App;

class Conversation
{
    /**
     * All information fetched from the database
     *
     * @var TelegramConversation|null
     */
    protected $conversation;

    /**
     * Notes to be stored
     *
     * @var mixed
     */
    public $notes;

    /**
     * Telegram user id
     *
     * @var int
     */
    protected $user_id;

    /**
     * Conversation constructor to initialize a new conversation
     *
     * @param int    $user_id
     *
     * @throws TelegramException
     */
    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;

        //Try to load an existing conversation if possible
        if (!$this->load()) {
            //A new conversation start
            $this->start();
        }
    }

    /**
     * Clear all conversation variables.
     *
     * @return bool Always return true, to allow this method in an if statement.
     */
    public function clear(): bool
    {
        $this->notes = [];

        return $this->update();
    }

    /**
     * Load the conversation from the database
     *
     * @return bool
     * @throws TelegramException
     */
    protected function load(): bool
    {
        //Select an active conversation
        $conversation = ConversationDB::selectConversation($this->user_id);
        if ($conversation) {
            //Pick only the first element
            $this->conversation = $conversation;

            //Load the conversation notes
            $this->notes        = json_decode($this->conversation->notes, true);
        }

        return $this->exists();
    }

    /**
     * Check if the conversation already exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return $this->conversation !== null;
    }

    /**
     * Start a new conversation if the current command doesn't have one yet
     *
     * @return bool
     * @throws TelegramException
     */
    protected function start(): bool
    {
        if (!$this->exists() && ConversationDB::insertConversation($this->user_id)) {
            return $this->load();
        }

        return false;
    }

    /**
     * Store the array/variable in the database with json_encode() function
     *
     * @return bool
     * @throws TelegramException
     */
    public function update(array $fields = []): bool
    {
        if ($this->exists()) {
            $this->notes = array_merge($this->notes, $fields);
            $fields = ['notes' => json_encode($this->notes, JSON_UNESCAPED_UNICODE)];
            return ConversationDB::updateConversation($fields, $this->user_id);
        }

        return false;
    }

    public function unsetNote($value): bool
    {
        if (isset($this->notes[$value])) {
            unset($this->notes[$value]);
        }
        
        return $this->update();
    }

    /**
     * Retrieve the user id
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function notes()
    {
        // return function ($key) {
        //     if (isset($this->notes[$key]) AND !empty($this->notes[$key]) AND !is_null($this->notes[$key])) {
        //         return $this->notes[$key];
        //     }
        //     return '';
        // };
        return (object) $this->notes;

    }
}