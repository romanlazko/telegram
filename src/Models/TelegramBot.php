<?php

namespace Romanlazko\Telegram\Models;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramBot extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'settings' => 'object',
    ];

    public function users()
    {
        return $this->hasMany(TelegramUser::class, 'telegram_bot_id', 'id');
    }

    public function chats()
    {
        return $this->hasMany(TelegramChat::class, 'telegram_bot_id', 'id');
    }

    public function updates()
    {
        return $this->hasMany(TelegramUpdate::class, 'telegram_bot_id', 'id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'telegram_bot_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(TelegramLog::class, 'telegram_bot_id', 'id')->latest()->get()->take(10);
    }

    public function getPhotoAttribute() 
    {
        
    }
}
