<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Romanlazko\Telegram\App\Entities\ChatInviteLink;
use Romanlazko\Telegram\App\Entities\ChatMember\ChatMember;

class TelegramChatMemberUpdate extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function getOldChatMember()
    {
        if($this->old_chat_member) {
            return ChatMember::fromRequest(json_decode($this->old_chat_member, true));
        }
        return null;
    }

    public function getNewChatMember()
    {
        if($this->old_chat_member) {
            return ChatMember::fromRequest(json_decode($this->new_chat_member, true));
        }
        return null;
    }

    public function getInviteLink()
    {
        if($this->old_chat_member) {
            return ChatInviteLink::fromRequest(json_decode($this->invite_link, true));
        }
        return null;
    }
}
