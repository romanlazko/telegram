<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Romanlazko\Telegram\App\Entities\ChatInviteLink;

class TelegramChatJoinRequest extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function getInviteLink()
    {
        if($this->old_chat_member) {
            return ChatInviteLink::fromRequest(json_decode($this->invite_link, true));
        }
        return null;
    }
}
