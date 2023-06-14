<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramUser extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function conversation()
    {
        return $this->hasOne(TelegramConversation::class, 'user', 'id');
    }
}
