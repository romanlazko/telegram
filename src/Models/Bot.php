<?php

namespace Romanlazko\Telegram\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bot extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->hasMany(TelegramUser::class, 'bot_id', 'id');
    }

    public function chats()
    {
        return $this->hasMany(TelegramChat::class, 'bot_id', 'id');
    }

    public function updates()
    {
        return $this->hasMany(TelegramUpdate::class, 'bot_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(TelegramLog::class, 'bot_id', 'id')->latest()->get()->take(10);
    }

    public function storeOrRestoreBot($id, $data)
    {
        $bot = Bot::withTrashed()->find($id);

        if ($bot && $bot->trashed()) {
            $bot->restore();
            $bot->update($data);
        } else if(!$bot) {
            $bot = $this->create($data);
        }

        return $bot;
    }

    
}
