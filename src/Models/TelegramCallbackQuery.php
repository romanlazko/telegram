<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramCallbackQuery extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    // public function message()
    // {
    //     return $this->belongsTo(TelegramMessage::class, 'message', 'message_id');
    // }
    public function user()
    {
        return $this->belongsTo(TelegramUser::class, 'from', 'id');
    }
}
