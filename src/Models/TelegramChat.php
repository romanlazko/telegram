<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramChat extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(TelegramMessage::class, 'chat', 'id');
    }

    public function bot()
    {
        return $this->belongsTo(Bot::class, 'bot_id', 'id');
    }
}
